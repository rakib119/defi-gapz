<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\InTransition;
use App\Models\ServiceFees;
use App\Models\TeamIncome;
use App\Models\User;
use App\Notifications\CongratulationsYouReceivedMoney;
use App\Notifications\MoneyTransferFromYourAccountSuccessfully;
use App\Notifications\TransferMoneyOtp;
use App\Notifications\WithdrawalOtpNotification;
use App\Notifications\WithdrawNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MineController extends Controller
{
    public function persoal_information()
    {

        return view('frontend.mine.personal_info', [
            'auth' => auth()->user(),
            'given_ans' => total_ans(),
            'required_ans'=>2
        ]);
    }
    public function change_name(Request $request)
    {
        if (!auth()->user()->name) {
            $request->validate([
                'name' => 'required|max:200'
            ]);
            $user = User::where('id', auth()->id())->first();
            $user->name = $request->name;
            $user->save();
            return back();
        }
    }
    public function change_wallet_address(Request $request)
    {
        if (!auth()->user()->wallet_address) {
            $request->validate([
                'wallet_address' => 'required|max:200|unique:users'
            ],[
                'wallet_address.unique' =>'Sorry ! Wallet address you entered is already used to  an another Defi Gapz account.'
            ]);
            $user = User::where('id', auth()->id())->first();
            $user->wallet_address = $request->wallet_address;
            $user->save();
            return back();
        }
    }
    public function add_bank_details(Request $request)
    {
        if (!auth()->user()->bank_account_no) {
            $request->validate([
                'full_name' => 'required|max:200',
                'bank_name' => 'required|max:200',
                'bank_account_no' => 'required|max:200',
                'branch_name' => 'required|max:200',
                'swift_or_iban_code' => 'nullable|max:200',
            ]);
            $user = User::where('id', auth()->id())->first();
            $user->full_name = $request->full_name;
            $user->bank_name = $request->bank_name;
            $user->bank_account_no = $request->bank_account_no;
            $user->branch_name = $request->branch_name;
            $user->swift_or_iban_code = $request->swift_or_iban_code;
            $user->save();
            return back();
        }
    }
    public function change_transaction_password(Request $request)
    {
        $request->validate([
            'transaction_password' => 'required|min:6|max:200'
        ]);
        $user = User::where('id', auth()->id())->first();
        if ($user->transaction_password) {
             $msg = 'Transaction Password modified successfully';
        }else{
            $msg = 'Transaction Password set successfully';
        }
        $user->transaction_password = Hash::make($request->transaction_password);
        $user->save();
        session()->forget('correct_ans');
        return redirect()->route('persoal_information')->with('success',$msg);
    }
    public function deposit_records(Request $request)
    {
        return view('frontend.mine.deposit_records', [
            'deposits' => InTransition::select('created_at','transaction_id','wallet_address','transaction_amount','transaction_amount','status')->where(['transaction_type' => 'deposit', 'uid' => auth()->user()->uid])->orderBy('id', 'DESC')->get()
        ]);
    }
    // Withdraw
    public function withdrawal_records(Request $request)
    {
        return view('frontend.mine.withdrawal_records', [
            'records' => AccountTransaction::where(['uid' => auth()->user()->uid, 'transaction_type' => 2])->get()
        ]);
    }
    public function withdraw_money()
    {
        return view('frontend.withdraw.withdraw_form', [
            'balance' =>  AccountStatement::where('uid', auth()->user()->uid)->select('balance')->first()->balance,
            'freeze_deposit' => freeze_deposit_amount(),
            'session_otp'=>session()->get('otp')
        ]);
    }
    public function withdraw_otp(Request $request)
    {
        $method_exist = DB::table('withdrawal_methods')->where('status',1)->where('method_id',$request->withdrawal_method)->count();
        if (has_lone()) {
            return back()->with('error', 'Insufficient Balance');
        }
        if ($request->withdrawal_method && $method_exist == 0) {
            return back()->with('error', 'Invalid method');
        }
        $user = auth()->user();
        $transaction_password = $user->transaction_password;
        $status = 0;
        // $wallet_address = $user->wallet_address;
        $balance =  AccountStatement::where('uid', $user->uid)->select('balance')->first()->balance;
        $balance =   $balance - freeze_deposit_amount();
        $fee =  ServiceFees::where('transaction_type', 2)->select('fees')->first()->fees;
        $withdrawal_amount = $request->withdrawal_amount;
        if ($fee > 0) {
            $service_fee =  $withdrawal_amount * ($fee / 100);
        } else {
            $service_fee =  0;
        }
        $available_widrawal_balance = (int) (($balance - 5) / (1 + ($fee / 100)));
        $request->validate([
            'withdrawal_method' => 'required|in:0,1',
            'transaction_password' => 'required',
            'withdrawal_amount' => 'required|numeric|min:20|lte:' . $available_widrawal_balance
        ], [
            'withdrawal_amount.lte' => "Maintain $5 minimum balance to keep membership active."
        ]);
        if ($request->withdrawal_method == 0) {
            if (!$user->wallet_address) {
                return back()->with('error', 'please set your wallet address first');
            } else {
                $status = 1;
            }
        } elseif ($request->withdrawal_method == 1) {
            if (!$user->bank_account_no) {
                return back()->with('error', 'please set your bank information first');
            } else {
                $status = 1;
            }
        } else {
            return back()->with('error', 'Invalid withdrawal method');
        }
        if ($status) {
            if ($transaction_password) {
                $password = Hash::check($request->transaction_password, $transaction_password);
                if ($password) {
                    $otp = rand(111111, 999999);
                    session()->put([
                        'withdrawal_method' => $request->withdrawal_method,
                        'withdrawal_amount' => $withdrawal_amount,
                        'service_fee' => $service_fee,
                        'total_withdrawal_amount' => $withdrawal_amount + $service_fee,
                        'otp' => $otp
                    ]);

                //    Notification::send($user, new WithdrawalOtpNotification);
                    return back();
                } else {
                    return back()->with('error', 'Incorrect Password');
                }
            } else {
                return back()->with('error', 'please set your transaction password first');
            }
        }
    }

    public function send_withdraw_request(Request $request)
    {
        if (has_lone()) {
            return back()->with('error', 'Insufficient Balance');
        }
        $AccountStatement =  AccountStatement::where('uid', auth()->user()->uid)->first();
        $balance = $AccountStatement->balance;
        $request->validate([
            'otp' => 'required'
        ],[
            'otp.required' => 'Something went wrong.'
        ]);
        $session_otp = session()->get('otp');
        $withdrawal_amount = session()->get('withdrawal_amount');
        $withdrawal_method = session()->get('withdrawal_method');
        $service_fee = session()->get('service_fee');
        $total_withdrawal_amount = session()->get('total_withdrawal_amount');
        if (insufficient_balance($withdrawal_amount, $service_fee)) {
            if ($request->ajax()) {
                return response(['error' => 'Insufficient Balance']);
            } else {
                return back()->with('error', 'Insufficient Balance');
            }
        }
        if ($session_otp == $request->otp) {
            $new_balance = $balance - $total_withdrawal_amount;
            $transaction_id = Str::random(11);
            session()->put('transaction_id', $transaction_id);
            AccountTransaction::insert([
                'uid' => auth()->user()->uid,
                'old_balance' => $balance,
                'transaction_id' => $transaction_id,
                'transaction_type' => 2,
                'transaction_amount' => $withdrawal_amount,
                'transaction_fee' => $service_fee,
                'subtotal' => $total_withdrawal_amount,
                'current_balance' => $new_balance,
                'withdrawal_method' => $withdrawal_method,
                'created_at' => Carbon::now(),
            ]);
            $AccountStatement->total_withdraw = $AccountStatement->total_withdraw + $total_withdrawal_amount;
            $AccountStatement->balance = $new_balance;
            $AccountStatement->save();
            $user = auth()->user();
            session()->put('s_user_name', $user->name);
            // Notification::send($user, new WithdrawNotification);
            session()->forget(['otp', 'withdrawal_amount', 'service_fee', 'withdrawal_method', 'total_withdrawal_amount', 'transaction_id','s_user_name']);
            return back()->with('withdraw_success', 'Your withdraw is on the way. it will reflect on your wallet within a short time.');
        } else {
            return back()->with('otp_error', 'Something went wrong');
        }
    }
    // transfer
    public function transfer_money_form()
    {
        return view('frontend.transfer.transfer_form', [
            'balance' =>  AccountStatement::where('uid', auth()->user()->uid)->select('balance')->first()->balance
        ]);
    }
    public function transfer_otp(Request $request)
    {
        if (has_lone()) {
            return back()->with('error', 'Insufficient Balance');
        }
        $transaction_password = auth()->user()->transaction_password;
        if ($transaction_password) {
            $password = Hash::check($request->transaction_password, $transaction_password);
            $balance =  AccountStatement::where('uid', auth()->user()->uid)->select('balance')->first()->balance;
            $fee =  ServiceFees::where('transaction_type', 3)->select('fees')->first()->fees;
            $request->validate([
                'uid' => 'required|exists:users,uid',
                'transaction_password' => 'required',
                'transfer_amount' => 'required|numeric|min:10|max:' . $balance
            ]);

            if ($password) {
                $transfer_amount = $request->transfer_amount;
                if ($fee > 0) {
                    $service_fee =  $transfer_amount * ($fee / 100);
                } else {
                    $service_fee =  0;
                }
                if (insufficient_balance($transfer_amount, $service_fee)) {
                    if ($request->ajax()) {
                        return response('error', 'Insufficient Balance');
                    } else {
                        return back()->with('error', 'Insufficient Balance');
                    }
                }
                $otp = rand(111111, 999999);
                session()->put([
                    'uid' => $request->uid,
                    'transfer_amount' => $transfer_amount,
                    'service_fee' => $service_fee,
                    'total_transfer_amount' => $transfer_amount + $service_fee,
                    'otp' => $otp
                ]);
                // $user = auth()->user();
                // Notification::send($user, new TransferMoneyOtp);
                return back();
            } else {
                return back()->with('transaction_password', 'Incorrect Password');
            }
        } else {
            return back()->with('transaction_password', 'please set your transaction password first');
        }
    }

    public function transfer_money_into_account(Request $request)
    {
        if (has_lone()) {
            return back()->with('error', 'Insufficient Balance');
        }
        $senderAccountStatement =  AccountStatement::where('uid', auth()->user()->uid)->first();
        $balance = $senderAccountStatement->balance;
        $request->validate([
            'otp' => 'required'
        ],[
            'otp.required' => 'Something went wrong'
        ]);
        $session_uid = session()->get('uid');
        $session_otp = session()->get('otp');
        $transfer_amount = session()->get('transfer_amount');
        $service_fee = session()->get('service_fee');
        $total_transfer_amount = session()->get('total_transfer_amount');
        if (insufficient_balance($transfer_amount, $service_fee)) {
            if ($request->ajax()) {
                return response('error', 'Insufficient Balance');
            } else {
                return back()->with('error', 'Insufficient Balance');
            }
        }
        if ($session_otp == $request->otp) {
            session()->forget(['uid', 'otp', 'transfer_amount', 'service_fee', 'total_transfer_amount']);
            $new_balance = $balance - $total_transfer_amount;
            $transaction_id = Str::random(15);
            $created_at =  Carbon::now();
            $transfer_id =  AccountTransaction::insertGetId([
                'uid' => auth()->user()->uid,
                'old_balance' => $balance,
                'transaction_id' =>  $transaction_id,
                'transaction_type' => 3,
                'transaction_amount' => $transfer_amount,
                'transaction_fee' => $service_fee,
                'subtotal' => $total_transfer_amount,
                'transfer_from' => auth()->user()->uid,
                'transfer_to' => $session_uid,
                'current_balance' => $new_balance,
                'created_at' => $created_at,
            ]);
            session()->put([
                'transaction_id' => $transaction_id,
                'sender_id' => auth()->user()->uid,
                'receiver_id' => $session_uid,
                'transaction_amount' => $transfer_amount,
                'transaction_fee' => $service_fee,
                'subtotal' => $total_transfer_amount,
                'created_at' => $created_at,
            ]);
            //sender Account Statement
            $senderAccountStatement->total_transfer = $senderAccountStatement->total_transfer + $total_transfer_amount;
            $senderAccountStatement->balance = $new_balance;
            $senderAccountStatement->save();
            //Receiver Account Statement
            $receiverAccountStatement =  AccountStatement::where('uid',  $session_uid)->first();
            $receiverBalance = $receiverAccountStatement->balance;
            $receiverAccountStatement->total_deposite = $receiverAccountStatement->total_deposite +  $transfer_amount;
            $receiverAccountStatement->balance = $receiverBalance + $transfer_amount;
            $receiverAccountStatement->save();
            /* $sender = User::where('uid',  auth()->user()->uid)->first();
            $receiver = User::where('uid',  $session_uid)->first();
            Notification::send($sender, new MoneyTransferFromYourAccountSuccessfully);
            Notification::send($receiver, new CongratulationsYouReceivedMoney); */
            session()->forget(['transaction_id', 'sender_id', 'receiver_id', 'transaction_amount', 'transaction_fee', 'subtotal', 'created_at', 'otp']);
            return back()->with('success', 'Thank you for sending money.');
        } else {
            return back()->with('otp_error', 'Please enter correct OTP');
        }
    }
    public function transfer_history()
    {
        $uid =  auth()->user()->uid;
        return view('frontend.mine.tranfer_history', [
            'histories' => DB::table('account_transactions')->whereRaw("transaction_type=3 and (transfer_from='$uid' OR transfer_to='$uid')")->orderBy('created_at', 'desc')->take(10)->get()
        ]);
    }
    // identification
    public function identify_authenticate()
    {
        return view('frontend.mine.identify_authenticate', [
            'info' => auth()->user()
        ]);
    }
    public function identify_authenticate_post(Request $request)
    {
        $request->validate([
            'identification_image' => 'required|mimes:png,jpg'
        ]);
        $user = User::find(auth()->id());
        if ($user->identification_image) {
        }
        $photo_name = Str::random(15) . '.' . $request->file('identification_image')->getClientOriginalExtension();
        Image::make($request->file('identification_image'))->save(public_path('assets/upload/identification_image/') . $photo_name);
        $user->identification_image = $photo_name;
        $user->identification_status = 3;
        $user->identification_request_time = Carbon::now();
        $user->save();
        return back();
    }
    // my team
    public function my_team()
    {
        return view('frontend.mine.my_team', [
            'teams' => User::where('reference', auth()->user()->uid)->get()
        ]);
    }
    // marchants list
    public function merchant_list()
    {
        return view('frontend.mine.marchants', [
            'merchants' => User::where('role', 2)->get()
        ]);
    }
    // team Member income list
    public function team_income_list()
    {
        return view('frontend.mine.team_member_income', [
            'incomes' => TeamIncome::where('uid', auth()->user()->uid)->orderBy('created_at', 'DESC')->get()
        ]);
    }
}
