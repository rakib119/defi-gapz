<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\InTransition;
use App\Models\ServiceFees;
use App\Models\TeamIncome;
use App\Models\User;
use App\Notifications\DeclineDepositeNotification;
use App\Notifications\DepositNotification;
use App\Notifications\FundingNotification;
use App\Notifications\WithdrawalSuccessNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class TransactionController extends Controller
{
    function deposit_view()
    {
        $charge = ServiceFees::where('transaction_type',1)->first('fees');
        return view('frontend.deposit', [
            'service_charge'=> $charge->fees*1 ,
            'previous_deposit' => InTransition::where(['transaction_type' => 'deposit', ['status', 0], 'uid' => auth()->user()->uid])->orderBy('id', 'DESC')->first(['transaction_fee','transaction_amount','subtotal']),
        ]);
    }
    function make_deposit_request(Request $request)
    {
        $has_req_data = InTransition::where(['transaction_type' => 'deposit', ['status', 0], 'uid' => auth()->user()->uid])->orderBy('id', 'DESC')->count();
        if($has_req_data){
            return back();
        }
        $request->validate([
            'transaction_amount' => 'required|numeric|min:30',
        ],[
            'transaction_amount.required' => 'Deposit Amount field is required',
            'transaction_amount.min' => 'Minimum deposit $30',
            'transaction_amount.numeric' => 'Only Number is allowed',
        ]);
        if(!auth()->user()->wallet_address){
            return back()->with('error', 'Please set your Wallet Address');
        }
        $transaction_amount = $request->transaction_amount;
        $transaction_fee = ServiceFees::where('transaction_type', 1)->first()->fees;
        $charge = number_format( $transaction_amount *  ( $transaction_fee/100 ),2 );
        $subtotal = $charge + $transaction_amount;
        InTransition::insert([
            'uid' => auth()->user()->uid,
            'transaction_type' => 'deposit',
            'transaction_amount' => $transaction_amount,
            'transaction_fee' => $charge,
            'subtotal' => $subtotal,
            'status' => 0,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('deposit_view');
    }
    function make_deposit_request_v1(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|unique:in_transitions|max:255',
            'wallet_address' => 'required|max:100',
            'transaction_amount' => 'required|numeric',
        ]);
        $transaction_amount = $request->transaction_amount;
        $transaction_fee = ServiceFees::where('transaction_type', 1)->first()->fees;
        $subtotal = $transaction_fee + $transaction_amount;
        InTransition::insert([
            'uid' => auth()->user()->uid,
            'transaction_id' => $request->transaction_id,
            'transaction_type' => 'deposit',
            'transaction_amount' => $transaction_amount,
            'transaction_fee' => $transaction_fee,
            'subtotal' => $subtotal,
            'wallet_address' => $request->wallet_address,
            'status' => 0,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Request submitted successfully');
    }
    public function deposit_request_list()
    {
        $InTransitions = DB::table('in_transitions','a')->join('users as b','b.uid','=','a.uid')->where(['a.transaction_type' => 'deposit'])->select('a.id','a.uid','a.subtotal','a.status','a.created_at','b.wallet_address','b.name','b.id as user_id','a.transaction_amount')->orderBy('a.id', 'DESC')->get();
        // $InTransitions = InTransition::where(['transaction_type' => 'deposit'])->orderBy('id', 'DESC')->get();
        return  view('backend.intransaction.deposit_request', compact('InTransitions'));
    }
    public function success_deposit(InTransition $inTransaction,Request $request)
    {
        // return $inTransaction;
        $request->validate([
            'transaction_amount' => 'required|numeric|min:30',
            'subtotal' => 'required|numeric|min:30',
        ]);
        $uid = $inTransaction->uid;
        $total_num_of_deposit = InTransition::where(['transaction_type'=>'deposit','uid'=>$uid])->count();
        $account_statement =  AccountStatement::where('uid', $uid)->first();
        $user = User::where('uid', $uid)->first();
        $transaction_amount = $request->transaction_amount;
        if ($inTransaction->transaction_amount !=  $transaction_amount)
        {
            $transaction_fee = ServiceFees::where('transaction_type', 1)->first()->fees;

            $charge = number_format( $transaction_amount *  ( $transaction_fee/100 ),2 );

            // $subtotal = $charge + $transaction_amount;
            $inTransaction->subtotal = $request->subtotal;
            $inTransaction->transaction_amount = $transaction_amount;
            $inTransaction->transaction_fee = $charge;
        }
        // insert data into AccountTransaction table
        $deposit_amount = $inTransaction->transaction_amount;
        session()->put('deposit_amount', $deposit_amount);
        session()->put('s_user_name', $user->name);
        AccountTransaction::insert([
            'uid' => $uid,
            'old_balance' => $account_statement->balance,
            // 'transaction_id' => $inTransaction->transaction_id,
            'transaction_type' => 1,
            'transaction_amount' => $deposit_amount,
            'transaction_fee' => $inTransaction->transaction_fee,
            // 'wallet_address' => $inTransaction->wallet_address,
            'subtotal' => $inTransaction->subtotal,
            'current_balance' => $account_statement->balance + $deposit_amount,
            'created_at' => Carbon::now(),
        ]);
        // update account_statement
        $account_statement->total_deposite += $deposit_amount;
        $account_statement->balance += $deposit_amount;
        $account_statement->save();
        // update inTransaction table status
        $inTransaction->status = 1;
        $inTransaction->save();

        // Referal Profit  for CEO / Marchents
        $ref_user = User::where(['uid'=>$uid])->first(['reference']) ;
        $ref_uid =$ref_user->reference;
        $ref_info = User::where('uid',$ref_uid)->where('role',2)->first(['uid']) ;

        if ( $ref_info && $ref_info->uid ){
            $ceo_uid = $ref_info->uid;
        }else{
            $ceo_uid = null;
        }
        if($ceo_uid &&  $total_num_of_deposit ==1 ){
            $bonus_ratio = 19.73;
            $bonus_amount = $deposit_amount * ($bonus_ratio /100);
            TeamIncome::insert([
                'uid' => $ceo_uid,
                'team_member_uid' =>  $uid,
                'profit' => $bonus_amount ,
                'team_member_profit' => $deposit_amount,
                'profit_ratio' => $bonus_ratio,
                'genaration' => 9, // marchents/ceo
                'created_at' => Carbon::now(),
            ]);
            $account_statement_ceo = AccountStatement::where('uid', $ceo_uid)->first();
            $account_statement_ceo->balance = $account_statement_ceo->balance +  $bonus_amount ;
            $account_statement_ceo->team_income = $account_statement_ceo->team_income +  $bonus_amount ;
            $account_statement_ceo->save();
        }

        // $user->notify(new DepositNotification);
        session()->forget('deposit_amount');
        session()->forget('s_user_name');
        return back()->with('success', 'Success');

    }
    public function add_fund(Request $request)
    {
        // return $inTransaction;
        $request->validate([
            'transaction_amount' => 'required|numeric|min:30',
            'uid' => 'required|exists:users,uid',
        ]);
        $uid = $request->uid;
        $user = User::where('uid', $uid)->first();
        $account_statement =  AccountStatement::where('uid', $uid)->first();

         // Insert Into InTransition
         $deposit_amount = $request->transaction_amount;
         $transaction_fee = ServiceFees::where('transaction_type', 1)->first()->fees;
         $charge = number_format( $deposit_amount *  ( $transaction_fee/100 ),2 );
         $subtotal = $charge + $deposit_amount;
         InTransition::insert([
             'uid' => $uid,
             'transaction_type' => 'deposit',
             'transaction_amount' => $deposit_amount,
             'transaction_fee' => $charge,
             'subtotal' => $subtotal,
             'status' => 1,
             'created_at' => Carbon::now(),
         ]);
        // insert data into AccountTransaction table

        session()->put('deposit_amount', $deposit_amount);
        session()->put('s_user_name', $user->name);
        AccountTransaction::insert([
            'uid' => $uid,
            'old_balance' => $account_statement->balance,
            'transaction_type' => 1,
            'transaction_amount' => $deposit_amount,
            'transaction_fee' => $charge,
            'subtotal' => $subtotal,
            'current_balance' => $account_statement->balance + $deposit_amount,
            'created_at' => Carbon::now(),
        ]);
        // update account_statement
        $account_statement->total_deposite += $deposit_amount;
        $account_statement->balance += $deposit_amount;
        $account_statement->save();

        $user->notify(new FundingNotification);
        session()->forget('deposit_amount');
        session()->forget('s_user_name');
        return back()->with('success', 'Success');

    }
    public function success_deposit_v1(InTransition $inTransaction)
    {
        $account_statement =  AccountStatement::where('uid', $inTransaction->uid)->first();
        $user = User::where('uid', $inTransaction->uid)->first();
        // insert data into AccountTransaction table
        session()->put('deposit_amount', $inTransaction->transaction_amount);
        AccountTransaction::insert([
            'uid' => $inTransaction->uid,
            'old_balance' => $account_statement->balance,
            'transaction_id' => $inTransaction->transaction_id,
            'transaction_type' => 1,
            'transaction_amount' => $inTransaction->transaction_amount,
            'transaction_fee' => $inTransaction->transaction_fee,
            'wallet_address' => $inTransaction->wallet_address,
            'subtotal' => $inTransaction->subtotal,
            'current_balance' => $account_statement->balance + $inTransaction->subtotal,
            'created_at' => Carbon::now(),
        ]);
        // update account_statement
        $account_statement->total_deposite = $account_statement->total_deposite + $inTransaction->subtotal;
        $account_statement->balance = $account_statement->balance + $inTransaction->subtotal;
        $account_statement->save();
        // update inTransaction table status
        $inTransaction->status = 1;
        $inTransaction->save();
        $user->notify(new DepositNotification);
        session()->forget('deposit_amount');
        return back()->with('success', 'Success');

    }
    public function decline_deposit(InTransition $inTransaction)
    {
        if ($inTransaction->status != 1) {
            $uid = $inTransaction->uid;
            $deposit_amount = $inTransaction->transaction_amount;
            // update status to decline

            $inTransaction->status = 2;
            $inTransaction->save();

            $user = User::where('uid', $uid)->first();

            session()->put('deposit_amount', $deposit_amount);
            session()->put('s_user_name', $user->name);
            // email
            $user->notify(new DeclineDepositeNotification);

            session()->forget('deposit_amount');
            session()->forget('s_user_name');
            return back()->with('success', 'Success');
        } else {
            return back()->with('error', 'You can not decline after success ');
        }
    }
    public function withdrawal_request_list()
    {
        return  view('backend.intransaction.withdrawal_request', [
            'withdrawal_records' => AccountTransaction::where(['transaction_type' => 2])->orderBy('created_at', 'desc')->get()
        ]);
    }
    public function withdrawal_success(AccountTransaction $withdraw)
    {
        $withdraw->status = 1;
        $withdraw->save();
        $uid = $withdraw->uid;
        $user = User::where('uid', $uid )->first();
        session()->put('s_user_name', $user->name);
        session()->put('withdrawal_amount', $withdraw->transaction_amount);
        Notification::send($user, new WithdrawalSuccessNotification);
        session()->forget('s_user_name');
        session()->forget('withdrawal_amount');
        return back()->with('success', 'success');
    }
    public function withdrawal_decline(AccountTransaction $withdraw)
    {
        $withdraw->status = 2;
        $withdraw->save();
        return back()->with('success', 'success');
    }

    public function cancle()
    {
        session()->forget([
            'withdrawal_amount',
            'service_fee',
            'total_withdrawal_amount',
            'transfer_amount',
        ]);
        return back();
    }
}
