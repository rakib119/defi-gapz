<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\FixedDepositeProfit;
use App\Models\AccountTransaction;
use App\Models\EarnFromInvestment;
use App\Models\User;
use App\Notifications\ImmediatePurchaseOtpNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EarnController extends Controller
{
    public function immediate_purchase($crypent_id)
    {
        try {
            $id = decrypt($crypent_id);
        } catch (Exception $e) {
            abort(404);
        }

        try {
            $fixed_deposit = FixedDepositeProfit::findOrFail($id);
        } catch (Exception $e) {
            abort(404);
        }
        return view('frontend.earn_invest.purchase_form', [
            'balance' =>  AccountStatement::where('uid', auth()->user()->uid)->select('balance')->first()->balance,
            'fixed_deposit' => $fixed_deposit
        ]);
    }
    public function investment_otp(FixedDepositeProfit $fixed_deposit, Request $request)
    {
        $profit = $fixed_deposit->profit;
        $transaction_password = auth()->user()->transaction_password;
        if ($transaction_password) {
            $password = Hash::check($request->transaction_password, $transaction_password);
            $balance =  AccountStatement::where('uid', auth()->user()->uid)->select('balance')->first()->balance;

            $request->validate([
                'transaction_password' => 'required',
                'investment_amount' => 'required|numeric|min:10|max:' . $balance
            ],[
                'investment_amount.max' => 'Insufficient Balance'
            ]);

            if (insufficient_balance($request->investment_amount, 0)) {
                if ($request->ajax()) {
                    return response(['error' => 'Insufficient Balance']);
                } else {
                    return back()->with('error', 'Insufficient Balance');
                }
            }
            if ($password) {
                $investment_amount = $request->investment_amount;
                if ($profit > 0) {
                    $total_profit =  $investment_amount * ($profit / 100);
                } else {
                    $total_profit =  0;
                }
                $otp = rand(111111, 999999);
                session()->put([
                    'investment_amount' => $investment_amount,
                    'total_profit' => $total_profit,
                    'otp' => $otp
                ]);
                // $user = auth()->user();
                // Notification::send($user, new ImmediatePurchaseOtpNotification);

                return back();
            } else {
                return back()->with('transaction_password', 'Incorrect Password');
            }
        } else {
            return back()->with('transaction_password', 'please set your transaction password first');
        }
    }
    public function investment_money(FixedDepositeProfit $fixed_deposit, Request $request)
    {
        $AccountStatement =  AccountStatement::where('uid', auth()->user()->uid)->first();
        $balance = $AccountStatement->balance;
        $request->validate([
            'otp' => 'required'
        ],[
            'otp.required'=>'Something went wrong'
        ]);
        $session_otp = session()->get('otp');
        $investment_amount = session()->get('investment_amount');
        $total_profit = session()->get('total_profit');
        if ($session_otp == $request->otp) {

            session()->forget(['otp', 'investment_amount', 'total_profit']);
            $new_balance = $balance - $investment_amount;
            EarnFromInvestment::insert([
                'uid' => auth()->user()->uid,
                'fixed_deposit_id' => $fixed_deposit->id,
                'no_of_days' => $fixed_deposit->days,
                'profit_ratio' => $fixed_deposit->profit,
                'transaction_id' => Str::random(11),
                'transaction_type' => 'investment',
                'total_profit' => $total_profit,
                'investment_amount' => $investment_amount,
                'sub_total' => $investment_amount + $total_profit,
                'created_at' => Carbon::now(),
            ]);
            // $AccountStatement->total_withdraw = $AccountStatement->total_withdraw + $total_withdrawal_amount;
            $AccountStatement->balance = $new_balance;
            $AccountStatement->save();

            $roi_period = $fixed_deposit->days > 1 ? $fixed_deposit->days.' Days' : $fixed_deposit->days.' Day';
            return back()->with('success','Investment confirmed!**Ok**Amount- $'.$investment_amount.'##ROI period- '.$roi_period.'##Expected profit- $'.$total_profit);
        } else {
            return back()->with('otp_error', 'Something went wrong');
        }
    }
}
