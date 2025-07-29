<?php

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
function pre($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";

}
function carbon_parse($date){
    return Carbon::parse($date);
}
function auth_uid()
{
    return auth()->user()->uid;
}
function auth_current_balance()
{
    return AccountStatement::where('uid', auth_uid())->select('balance')->first()->balance;
}

function updated_balance($transaction_amount, $service_charge)
{

    $curent_balance = auth_current_balance();
    $total_transaction = $transaction_amount + $service_charge;
    $updated_balance = $curent_balance - $total_transaction;
    return  $updated_balance;
}
function clear_session()
{
    session()->forget([
        'deposit_amount',
        'withdrawal_amount',
        'transfer_amount',
        'otp',
        'uid',
        'withdrawal_amount',
        'service_fee',
        'total_withdrawal_amount',
        'total_transfer_amount',
        'transfer_amount',
        'transaction_id',
        'sender_id',
        'receiver_id',
        'transaction_amount',
        'transaction_fee',
        'subtotal',
        'created_at',
        'session_market_price',
        'session_transaction_amount',
        'session_order_amount',
        'session_region',
        'session_supplier',
        'investment_amount',
        'total_profit',
    ]);
}

function insufficient_balance($transaction_amount, $service_charge)
{
    $updated_balance =  updated_balance($transaction_amount, $service_charge);
    if ($updated_balance <= 2) {
        clear_session();
        return true;
    }
}
function has_lone()
{
    $auth_balance =  auth_current_balance();
    if ($auth_balance <= 2) {
        clear_session();
        return true;
    }
}
function account_transaction_amount($transaction_type, $column, $uid)
{
    return DB::table('account_transactions')->where(['uid' => $uid, 'transaction_type' => $transaction_type])->sum($column);
}
function team_income($uid)
{
    return  DB::table('team_incomes')
        ->select('profit')
        ->where('uid', $uid)
        ->sum('profit');
}
function profit_from_trade($uid)
{
    return  DB::table('account_transactions')
        ->select('profit')
        ->where(['uid' => $uid, 'transaction_type' => 5, ['old_balance', '>', 0], ['current_balance', '>', 0]])
        ->sum('profit');
}
function total_deposit_amount($uid)
{
    return account_transaction_amount(1, 'subtotal', $uid);
}
function total_withdraw_amount($uid)
{
    return account_transaction_amount(2, 'subtotal', $uid);
}
function total_investment_profit($uid)
{
    return DB::table('account_transactions')->where(['uid' => $uid, 'transaction_type' => 4])->sum('profit');
}
function total_received_amount($uid)
{
    return account_transaction_amount(3, 'subtotal', $uid);
}
function send_money($uid)
{
    return DB::table('account_transactions')->where(['transfer_from' => $uid, 'transaction_type' => 3])->sum('subtotal');
}
function original_balance($uid)
{
    $deposit = total_deposit_amount($uid);
    $withdraw =  total_withdraw_amount($uid);
    $received_amount =  total_received_amount($uid);
    $send_money = send_money($uid);
    $team_income = team_income($uid);
    $trade_profit =  profit_from_trade($uid);
    $investment_profit =  total_investment_profit($uid);

    $balance = $deposit + $team_income + $trade_profit + $received_amount + $investment_profit - ($withdraw + $send_money);
    return number_format($balance, 2);
}

function user_name($uid)
{
    return  User::withTrashed()->where('uid', $uid)->select('name')->first()->name;
}
function user_id($uid)
{
    return  User::withTrashed()->where('uid', $uid)->select('id')->first()->id;
}
function freeze_deposit_amount($uid=null)
{
    if(!$uid){
        $uid = auth()->user()->uid;
    }
    $deposit =  DB::table('account_transactions')->where('uid',$uid)->where('transaction_type',1)->first('created_at');

    $deposit_time = 0;
    if($deposit)
    {
        $deposit_date=Carbon::parse($deposit->created_at);
        $now=Carbon::now();
        $deposit_time = $deposit_date->diffInDays($now);
        $account = DB::table('account_statements')->where('uid', $uid)->first(['total_deposite','total_transfer']);
        $deposit_amount = $account->total_deposite;
        $transfer_amount = $account->total_transfer;
        $total_deposit= $deposit_amount + $transfer_amount;
    }
   return ($deposit_time < 11) ? $total_deposit : 0;
}


//=========================================================================================
//                                       Secret Questions Helpers
//=========================================================================================

function get_questions($min_given_ans=2,$uid="")
{
    $ans_ids =get_ans_id_arr($uid);
    $qsn_query = DB::table('secret_questions')->select(['id','question']);
    if (count($ans_ids)>0) {
        $qsn_query = $qsn_query->whereNotIn('id',$ans_ids);
    }
    return $qsn_query->get();
}

function get_secret_ans($columns=['qsn_id'],$uid="")
{
    if ($uid=="")  $uid = auth_uid();
    return DB::table('secret_qsn_ans')->select($columns)->where('uid',$uid)->get();
}
function get_ans_id_arr($uid=""){
    if ($uid=="")  $uid = auth_uid();
    $i =0;
    $ans_ids = array();
    foreach (get_secret_ans('qsn_id',$uid) as $v) {
        $ans_ids [$i++]= $v->qsn_id ;
    }
    return  $ans_ids;
}

function total_ans($uid="")
{
    if ($uid=="")  $uid = auth_uid();
    return  DB::table('secret_qsn_ans')->where('uid',$uid)->count();
}

// ==============================  Short Number Formater Start ==================================

function number_format_short( $n, $precision = 1 ) {
	if ($n < 900) {
		// 0 - 900
		$n_format = number_format($n, $precision);
		$suffix = '';
	} else if ($n < 900000) {
		// 0.9k-850k
		$n_format = number_format($n / 1000, $precision);
		$suffix = 'K';
	} else if ($n < 900000000) {
		// 0.9m-850m
		$n_format = number_format($n / 1000000, $precision);
		$suffix = 'M';
	} else if ($n < 900000000000) {
		// 0.9b-850b
		$n_format = number_format($n / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($n / 1000000000000, $precision);
		$suffix = 'T';
	}

  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
	if ( $precision > 0 ) {
		$dotzero = '.' . str_repeat( '0', $precision );
		$n_format = str_replace( $dotzero, '', $n_format );
	}

	return $n_format . $suffix;
}
// ==============================  Short Number Formater End   ==================================

