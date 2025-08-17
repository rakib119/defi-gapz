<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use App\Models\InTransition;
use App\Models\TeamIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionHistoryController extends Controller
{
    public function transactions_history()
    {

        return view('backend.history.transaction_history');
    }
    public function team_income_history()
    {
    }

    public function get_transactions_history()

    {
        $transactions = AccountTransaction::select('id', 'uid', 'old_balance', 'transaction_id', 'transaction_amount', 'profit', 'current_balance', 'subtotal')->get();
        return  datatables()->collection($transactions)->toJson();
    }
    public function freeze_amount_history()
    {

        $inTransitions = InTransition::where([
                'transaction_type' => 'competition',
                'status' => 0
            ])
            ->select('uid', 'transaction_amount')
            ->get();

        $investments = DB::table('earn_from_investments')
            ->where('status', 0)
            ->select('uid', 'investment_amount')
            ->get();

        // Merge both collections into one
        $allData = collect();
        $total_transaction=0;
        foreach ($inTransitions as $row) {
            $total_transaction +=$row->transaction_amount;
            $allData->push([
                'uid' => $row->uid,
                'transaction_amount' => $row->transaction_amount,
                'investment_amount' => 0,
            ]);
        }

        $total_investment=0;
        foreach ($investments as $row) {
            $total_investment +=$row->investment_amount;
            $allData->push([
                'uid' => $row->uid,
                'transaction_amount' => 0,
                'investment_amount' => $row->investment_amount,
            ]);
        }

        // Group by uid and sum in PHP
        $freeze_amount = $allData->groupBy('uid')->map(function ($rows, $uid) {
            return [
                'uid' => $uid,
                'total_transaction' => $rows->sum('transaction_amount'),
                'total_investment'  => $rows->sum('investment_amount'),
            ];
        })->values();

        return view('backend.history.freez_amount_history',compact(['freeze_amount','total_transaction','total_investment']));
    }
    public function user_deposit_history($uid)
    {
        $transactions = AccountTransaction::where(['uid' => $uid, 'transaction_type' => 1])
            ->orderBy('created_at', 'desc')
            ->select('uid', 'transaction_id', 'old_balance', 'subtotal', 'current_balance', 'created_at')
            ->get();
        $name =  user_name($uid);
        return view('backend.users.history.deposit', [
            'transactions' => $transactions,
            'name' => $name,
            'uid' => $uid
        ]);
    }
    public function user_withdrawal_history($uid)
    {
        $transactions = AccountTransaction::where(['uid' => $uid, 'transaction_type' => 2])
            ->orderBy('created_at', 'desc')
            ->select('uid', 'transaction_id', 'old_balance', 'transaction_amount', 'transaction_fee', 'subtotal', 'current_balance', 'created_at')
            ->get();
        $name =  user_name($uid);
        return view('backend.users.history.withdrawal', [
            'transactions' => $transactions,
            'name' => $name,
            'uid' => $uid
        ]);
    }
    public function user_transfer_history($uid)
    {
        $transactions = AccountTransaction::where(['transfer_from' => $uid, 'transaction_type' => 3])
            ->orderBy('created_at', 'desc')
            ->select('uid', 'transaction_id', 'old_balance', 'transaction_amount', 'transaction_fee', 'subtotal', 'current_balance', 'created_at')
            ->get();
        $name =  user_name($uid);
        return view('backend.users.history.transfer', [
            'transactions' => $transactions,
            'name' => $name,
            'uid' => $uid
        ]);
    }
    public function user_transfer_history_received($uid)
    {
        $transactions = AccountTransaction::where(['uid' => $uid, 'transaction_type' => 3])
            ->orderBy('created_at', 'desc')
            ->select('uid', 'transaction_id', 'old_balance', 'transaction_amount', 'current_balance', 'transfer_from', 'created_at')
            ->get();
        $name =  user_name($uid);
        return view('backend.users.history.transfer_received', [
            'transactions' => $transactions,
            'name' => $name,
            'uid' => $uid
        ]);
    }
    public function user_team_income_history($uid)
    {
        $transactions = TeamIncome::where('uid', $uid)->orderBy('created_at', 'desc')->get();
        $name =  user_name($uid);
        return view('backend.users.history.team_income', [
            'transactions' => $transactions,
            'name' => $name,
            'uid' => $uid
        ]);
    }
    public function user_trade_history($uid)
    {
        $transactions = AccountTransaction::where(['uid' => $uid, 'transaction_type' => 5])
            ->select('id', 'transaction_id', 'old_balance', 'transaction_amount', 'current_balance', 'profit', 'subtotal', 'created_at')
            ->orderBy('created_at', 'desc')->get();
        $name =  user_name($uid);
        return view('backend.users.history.trade', [
            'transactions' => $transactions,
            'name' => $name,
            'uid' => $uid
        ]);
    }

}
