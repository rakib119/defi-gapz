<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\competitionTransitionDetail;
use App\Models\InTransition;
use App\Models\supplier;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{
    public function get_compitition_pricing()
    {
        $AccountStatement = AccountStatement::where('uid', auth()->user()->uid)->first();
        $balance = $AccountStatement->balance;
        if ($balance >= 5) {
            $total_supplier  = supplier::count();
            $random_id =  rand(1, $total_supplier);
            $supplier_details = supplier::find($random_id);
            $supplier = $supplier_details->supplier_name;
            $region = $supplier_details->region;
            $decimals = 3; // number of decimal places
            $div = pow(10, $decimals);
            // Syntax: mt_rand(min, max);

            $min_market_price = $supplier_details->min_market_price;
            $max_market_price = $supplier_details->max_market_price;
            $min_transaction_price = $supplier_details->min_transaction_price;

            $max_transaction_price = $supplier_details->max_transaction_price;

            $market_price = mt_rand($min_market_price * $div, $max_market_price * $div) / $div;
            $transaction_price = mt_rand($min_transaction_price * $div, $max_transaction_price * $div) / $div;
            $min_order =  $balance / 3;
            $order_amount = mt_rand($min_order * $div, $balance * $div) / $div;

            Session::put([
                'session_market_price' => $market_price,
                'session_transaction_amount' => $transaction_price,
                'session_order_amount' => $order_amount,
                'session_region' => $region,
                'session_supplier' => $supplier,
            ]);
            return response([
                'market_price' => $market_price,
                'transaction_amount' => $transaction_price,
                'order_amount' => $order_amount,
                'region' => $region,
                'supplier' => $supplier,
            ]);
        } else {
            return response([
                'balance' => $balance
            ]);
        }
    }
    public function compitition_sell(Request $request)
    {
        $decimals = 3; // number of decimal places
        $div = pow(10, $decimals);
        $uid = auth()->user()->uid;
        $order_no = Str::random(11);
        $region = session()->get('session_region');
        $supplier = session()->get('session_supplier');
        $market_price = session()->get('session_market_price');
        $transition_amount = session()->get('session_transaction_amount');
        $order_amount = session()->get('session_order_amount');

        $service_fees = DB::table('service_fees')->where('transaction_type',5)->first('fees');
        $service_fees_ratio =  $service_fees->fees;
        $profit_margin  = mt_rand(0.57 * $div, 0.73 * $div) / $div;
        $profit = $order_amount * ($profit_margin / 100);
        $profit = number_format($profit, 3);
        $charege = $profit *  ($service_fees_ratio/100);
        $charege = number_format($charege,3);
        if (insufficient_balance($order_amount,$charege)) {
            if ($request->ajax()) {
                return response(['error' => 'Insufficient Balance']);
            } else {
                return back()->with('error', 'Insufficient Balance');
            }
        }
        if ($region != NULL  && $supplier != NULL && $market_price != NULL && $transition_amount != NULL && $order_amount != NULL) {
            $last_inserted_data = competitionTransitionDetail::where('uid', $uid)->whereDate('created_at', today())->orderBy('created_at', 'desc');
            if ($last_inserted_data->exists()) {
                $last_inserted_time =  $last_inserted_data->first()->created_at->diffInMinutes();
                $batch_no  = $last_inserted_data->first()->batch_no;
                // if last competion is 60 min ago
                if ($last_inserted_time > 60) {
                    if ($batch_no < 4) {
                        $batch_no++;
                    }
                }
            } else {
                $batch_no = 0;
            }
            competitionTransitionDetail::insert([
                'uid' => $uid,
                'order_no' => $order_no,
                'region' => $region,
                'batch_no' => $batch_no,
                'supplier' => $supplier,
                'market_price' => $market_price,
                'transition_amount' => $transition_amount,
                'order_amount' => $order_amount,
                'profit' => $profit,
                'created_at' => Carbon::now(),
            ]);
            InTransition::insert([
                'uid' => $uid,
                'transaction_id' => $order_no,
                'transaction_type' => 'competition',
                'transaction_amount' => $order_amount,
                'transaction_fee' => $charege,
                'subtotal' => $order_amount + $charege,
                'created_at' => Carbon::now(),
                'status' => 0,
            ]);
            $account_statement =   AccountStatement::where('uid', $uid)->first();
            $account_statement->decrement('balance',($order_amount + $charege));
            if ($order_amount > 0) {
                return response([
                    'order_no' => $order_no,
                    'transaction_amount' => $order_amount,
                    'profit' => $profit,
                    'trading_fees' => $charege,
                ]);
            }else{
                return response(['error' => 'Your transaction has been declined due to market price instability. Try again !']);
            }

        } else {
            return response();
        }
    }
    public function competition_statistics()
    {
        return view('frontend.statistics', [
            'account_transaction' => AccountTransaction::where(['uid' => auth()->user()->uid, 'transaction_type' => 5])->get(),
            'competitionTransitions' => competitionTransitionDetail::where(['uid' => auth()->user()->uid])->get(),
        ]);
    }
}
