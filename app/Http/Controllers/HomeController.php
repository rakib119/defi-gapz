<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\InTransition;
use App\Models\User;
use App\Models\withdrawalMethod;
use App\Notifications\AccountAdjustmentNotification;
use App\Notifications\UserVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        return  view('backend.home.index', [
            'users' => User::where('role', '!=', '1')->count(),
            // 'ten_users' =>  User::where('role', '!=', '1')->take(10)->get(),
            'deposit_request' => InTransition::select('id')->where(['transaction_type' => 'deposit', ['status', '=', 0]])->count(),
            'withdrawal_records' => AccountTransaction::select('id')->where(['transaction_type' => 2, 'status' => 0])->count(),
            'verify_request' => User::where([['role', '!=', '1'], ['identification_status', '3']])->whereNotNull('identification_request_time')->count(),
            'withdrawal_methdos'=> withdrawalMethod::get(['id','method','status'])
        ]);
    }
    public function change_withdrawal_method_status(withdrawalMethod $method)
    {
        if($method->status == 1){
            $method->status = 0;
        }else{
            $method->status = 1;
        }
        $method->save();
        return back()->with('success','Method Status Updated');
    }
    public function get_users(Request $request)
    {
        $query_str = $request->query_str;
        $users =DB::table('users','a')
                    ->join('account_statements as b','a.uid','=','b.uid')
                    ->where('a.role', '!=', '1')
                    ->where('a.deleted_at', '=', NULL)
                    ->where(function ($query) use ($query_str) {
                        $query->orWhere(function ($query) use ($query_str) {
                            return $query->Where('a.name', 'like', '%' . $query_str . '%')
                                ->orWhere('a.email', 'like', '%' . $query_str . '%')
                                ->orWhere('a.uid', 'like', '%' . $query_str . '%')
                                ->orWhere('a.mobile', 'like', '%' . $query_str . '%')
                                ->orWhere('a.wallet_address', 'like', '%' . $query_str . '%');
                        });
                    })
                    ->select('a.id','a.name','a.uid','a.role','a.country','a.identification_status','b.balance')
                    ->take(10)->get();

        $v = view('backend.small_part.user_table_row', compact('users'));

        return response()->json([
            'view' => (string)$v,
            'user' => count($users) ? true : false,
            'query' =>  $query_str,

        ]);
    }
    public function verify_request_list()
    {
        $users = DB::table('users','a')
                ->join('account_statements as b','a.uid','=','b.uid')
                ->where('a.role', '!=', '1')
                ->where('a.identification_status', 3)
                ->whereNotNull('a.identification_request_time')
                ->where('a.deleted_at', '=', NULL)
                ->select('a.id','a.name','a.uid','a.role','a.country','a.identification_status','b.balance')
                ->orderBy('a.updated_at', 'DESC')
                ->get();
        return  view('backend.users.user_list_v2', [
            'users' =>  $users
        ]);
    }
    public function users_list(Request $request)
    {
        return view('backend.users.user_list');
        /* if ($request->ajax()) {
            $num = 300;
            $users = User::where('role', '!=', '1')->paginate($num);
            $page = (int)$request->page;
            $i = $num * ($page - 1);
            return  view('backend.small_part.action', compact('users', 'i'));
        } else {
            return view('backend.user_list.blade_v2.php');
        } */
    }
    public function destroy(User  $user)
    {
        $user->delete();
        return back()->with('success', 'user suspanded successfully');
    }
    public function user_delete_permanently($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $in_transaction =   $user->in_transaction;
        $account_transaction =   $user->account_transaction;
        if ($in_transaction->isEmpty() && $account_transaction->isEmpty()) {
            $user->forceDelete();
            return back()->with('success', 'success');
        } else {
            return back()->with('error', "You can not delete this user");
        }
    }
    public function suspended_user_list()
    {
        return view('backend.users.suspended_list', [
            'users' => User::onlyTrashed()->where('role', '!=', '1')->orderBy('id', 'DESC')->get()
        ]);
    }
    public function cancle_suspenssion($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->deleted_at = NULL;
        $user->save();
        return back()->with('success', 'suspenssion cancelled');
    }
    public function user_details(User  $user)
    {
        return view('backend.users.user_details', compact('user'));
    }
    public function user_status_update(Request $request, User  $user)
    {
        $request->validate([
            'role' => 'required|in:0,2'
        ]);
        $user->role = $request->role;
        $user->save();
        return back()->with('success', 'success');
    }
    public function user_telegram_update(Request $request, User  $user)
    {
        $request->validate([
            'telegram' => 'required|max:255'
        ]);
        $user->telegram = $request->telegram;
        $user->save();
        return back()->with('success', 'success');
    }
    public function update_user(Request $request, User  $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->wallet_address = $request->wallet_address;
        $user->full_name = $request->full_name;
        $user->bank_name = $request->bank_name;
        $user->branch_name = $request->branch_name;
        $user->bank_account_no = $request->bank_account_no;
        $user->swift_or_iban_code = $request->swift_or_iban_code;
        $user->save();
        return back()->with('success', 'success');
    }

    public function user_verify(Request $request, User  $user)
    {
        $request->validate([
            'identification_status' => 'required|in:1,2'
        ]);
        $user->identification_status = $request->identification_status;
        $user->identification_time = Carbon::now();
        $user->save();
        if ($request->identification_status == 1) {
            session()->put('uid', $user->uid);
            $user->notify(new UserVerification);
            session()->forget('uid');
        }
        return back()->with('success', 'success');
    }
    public function edit_blance_statement_form($uid)
    {
        return view('backend.users.account_statement.edit', [
            'old_statement' => AccountStatement::where('uid', $uid)->first()
        ]);
    }
    public function edit_blance_statement_post(Request $request, $uid)
    {
        $request->validate([
            'balance' => 'required|numeric',
            'total_deposite' => 'required|numeric',
            'total_withdraw' => 'required|numeric',
        ]);
        $user_id =  User::withTrashed()->where('uid', $uid)->select('id')->first()->id;
        $account_statement = AccountStatement::where('uid', $uid)->first();
        $account_statement->balance = $request->balance;
        $account_statement->total_deposite = $request->total_deposite;
        $account_statement->total_withdraw = $request->total_withdraw;
        $account_statement->updated_at = Carbon::now();
        $account_statement->updated_by = auth()->id();
        $account_statement->save();
        return redirect()->route('user_details', $user_id)->with('success', '');
    }
    public function deduct_blance_form($uid)
    {
        return view('backend.users.account_statement.deduct_balance', [
            'old_statement' => AccountStatement::where('uid', $uid)->first(['balance','uid']),
            'user_id'=> User::where('uid', $uid)->first('id')->id
        ]);
    }
    public function deduct_blance_post(Request $request, $uid)
    {
        $request->validate([
            'balance' => 'required|numeric',
            'email_body' => 'required',
        ]);
        $user =  User::where('uid', $uid)->select()->first();
        $user_id = $user->id;
        $user_name = $user->name;
        $account_statement = AccountStatement::where('uid', $uid)->first();
        $account_statement->balance = $request->balance;
        $account_statement->updated_at = Carbon::now();
        $account_statement->updated_by = auth()->id();
        $account_statement->save();

        session()->put('s_user_name', $user_name);
        session()->put('s_email_body', $request->email_body);
        $user->notify(new AccountAdjustmentNotification);
        session()->forget('s_user_name');
        session()->forget('s_email_body');

        return redirect()->route('deduct_blance_form', $uid)->with('success', 'success');
    }
}
