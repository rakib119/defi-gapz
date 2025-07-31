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
use Illuminate\Support\Facades\Http;
class CompetitionController extends Controller
{
    public function get_compitition_pricing()
    {
        $AccountStatement = AccountStatement::where('uid', auth()->user()->uid)->first();
        $balance = $AccountStatement->balance;
        if ($balance >= 10)
        {
            $advNo=$classify=$nickName=$fiatUnit="";
            $market_price=$transaction_price=$order_amount=0;

            $decimals   = 3; // number of decimal places
            $div        = pow(10, $decimals);
            $is_hit_api = 1;

            if ($is_hit_api==1)
            {
                $fiatArray = ['USD', 'EUR', 'GBP', 'CNY', 'UAH', 'TRY', 'KES', 'VND', 'INR', 'PKR', 'AED', 'SAR']; //'AUD','CAD','JPY', 'RUB', 'NGN', 'BRL', 'ZAR'

                $fiat = $fiatArray[array_rand($fiatArray)];
                $page = rand(1, 5);
                // Binance API endpoint for fetching advertisements
                $url = 'https://p2p.binance.com/bapi/c2c/v2/friendly/c2c/adv/search';
                $data = [
                    'page'      => $page,
                    'rows'      => 5,
                    'asset'     => 'USDT',
                    'fiat'      => $fiat,
                    'tradeType' => 'SELL',
                    'payTypes'  => [],
                    'countries' => [],
                ];
                $response = Http::post($url, $data);

                // get Adv no ,Trade type ,Asset ,Fiat unit ,Price ,Payment method,nickName
                $responseData = $response->json();

                //select random adv from response
                if ($responseData['success'] && count($responseData['data']) > 0)
                {

                    try
                    {
                        $rand_select        = rand(0, count($responseData['data']) - 1);
                        $responseData       = $responseData['data'][$rand_select];
                        $adv                = $responseData['adv'];
                        $advertiser         = $responseData['advertiser'];
                        $advNo              = $adv['advNo'];
                        $classify           = $adv['classify'];
                        $nickName           = $advertiser['nickName'];
                        $fiatUnit           = $adv['fiatUnit'];
                        $transaction_price  = $adv['price'];
                        //$less_percentage between 0.55 and 0.95
                        $min                = 0.55;
                        $max                = 0.95;
                        $randomFloat        = $min + ($max - $min) * (rand(0, PHP_INT_MAX) / PHP_INT_MAX);
                        $less_percentage    = number_format($randomFloat,2);
                        $less_amount        = $less_percentage * $transaction_price / 100;
                        $market_price       = $transaction_price-$less_amount;
                    } catch (\Exception $e)
                    {
                        return response([
                            'balance'   => $balance,
                            'has_error' => true,
                            'error_msg' => 'No advertisements found please try again later',
                        ]);
                    }
                }
                else
                {
                    return response([
                        'balance'   => $balance,
                        'has_error' => true,
                        'error_msg' => 'No advertisements found please try again later',
                    ]);
                }

            }
            else
            {
                $total_supplier     = supplier::count();
                $random_id          = rand(1, $total_supplier);
                $supplier_details   = supplier::find($random_id);
                /* $supplier           = $supplier_details->supplier_name;
                $region             = $supplier_details->region; */
                $advNo              = "";
                $classify           = "mass";
                $nickName           = "";
                $fiatUnit           = "";

                // Syntax: mt_rand(min, max);

                $min_market_price       = $supplier_details->min_market_price;
                $max_market_price       = $supplier_details->max_market_price;
                $min_transaction_price  = $supplier_details->min_transaction_price;
                $max_transaction_price  = $supplier_details->max_transaction_price;
                $market_price           = mt_rand($min_market_price * $div, $max_market_price * $div) / $div;
                $transaction_price      = mt_rand($min_transaction_price * $div, $max_transaction_price * $div) / $div;


            }

            $min_order      = $balance / 3;
            $order_amount   = mt_rand($min_order * $div, $balance * $div) / $div;
            Session::put([
                'session_market_price'          => $market_price,
                'session_transaction_amount'    => $transaction_price,
                'session_order_amount'          => $order_amount,
                'adv_no'                        => $advNo,
                'nick_name'                     => $nickName,
                'session_region'                => "",
                'session_supplier'              => ""
            ]);
            return response([
                'opportunities'         => rand(15, 35),
                'has_error'             => false,
                'error_msg'             => "",
                'adv_no'                => $advNo,
                'classify'              => $classify,
                'nick_name'             => $nickName,
                'fiat'                  => $fiatUnit,
                'market_price'          => $market_price,
                'transaction_amount'    => $transaction_price,
                'order_amount'          => $order_amount,
                'balance'               => $balance
            ]);
        } else {
            return response([
                'balance'   => $balance,
                'has_error' => true,
                'error_msg' => 'You don\'t have sufficient fund to place the new order for trade. Deposit to continue!',
            ]);
        }
    }
    public function compitition_sell(Request $request)
    {
        $decimals   = 3; // number of decimal places
        $div        = pow(10, $decimals);
        $uid        = auth()->user()->uid;
        $order_no   = Str::random(11);
        /* $region = session()->get('session_region');
        $supplier = session()->get('session_supplier'); */
        $market_price       = session()->get('session_market_price')*1;
        $transition_amount  = session()->get('session_transaction_amount')*1;
        $order_amount       = session()->get('session_order_amount')*1;

        $service_fees       = DB::table('service_fees')->where('transaction_type',5)->first('fees');
        $service_fees_ratio =  $service_fees->fees;
        $profit_margin      = mt_rand(0.57 * $div, 0.73 * $div) / $div;
        $profit             = $order_amount * ($profit_margin / 100);
        $profit             = number_format($profit, 3);
        $charege            = $profit *  ($service_fees_ratio/100);
        $charege            = number_format($charege,3);

        if (insufficient_balance($order_amount,$charege)) {
            if ($request->ajax()) {
                return response(['error' => 'Insufficient Balance']);
            } else {
                return back()->with('error', 'Insufficient Balance');
            }
        }
        if ($market_price != NULL && $transition_amount != NULL && $order_amount != NULL) {
            $last_inserted_data = competitionTransitionDetail::where('uid', $uid)->whereDate('created_at', today())->orderBy('created_at', 'desc');
            if ($last_inserted_data->exists()) {
                $last_inserted_time =  $last_inserted_data->first()->created_at->diffInMinutes();
                $batch_no           = $last_inserted_data->first()->batch_no;
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
                'uid'               => $uid,
                'order_no'          => $order_no,
                'region'            => "",
                'batch_no'          => $batch_no,
                'supplier'          => "",
                'market_price'      => $market_price,
                'transition_amount' => $transition_amount,
                'order_amount'      => $order_amount,
                'profit'            => $profit,
                'created_at'        => Carbon::now(),
            ]);
            InTransition::insert([
                'uid'               => $uid,
                'transaction_id'    => $order_no,
                'transaction_type'  => 'competition',
                'transaction_amount'=> $order_amount,
                'transaction_fee'   => $charege,
                'subtotal'          => $order_amount + $charege,
                'created_at'        => Carbon::now(),
                'status'            => 0,
            ]);
            $account_statement =   AccountStatement::where('uid', $uid)->first();
            $account_statement->decrement('balance',($order_amount + $charege));
            if ($order_amount > 0) {
                return response([
                    'order_no'          => $order_no,
                    'transaction_amount'=> $order_amount,
                    'profit'            => $profit,
                    'trading_fees'      => $charege,
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
