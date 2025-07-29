<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\InTransition;
use App\Models\TeamIncome;
use App\Models\User;
use App\Notifications\DepositNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlockchainPaymentController extends Controller
{
    private $api_key = '6ZAB4MS-0S64EA1-JVH5G94-482AMAP';
    public function createPayment(Request $request)
    {
        $request->validate([
            'transaction_amount' => 'required|numeric|min:5' // Minimum $5 for TRX
        ]);

        try {
            $payload = [
                'price_amount'          => round($request->transaction_amount, 2),
                'price_currency'        => 'usdttrc20',
                'pay_currency'          => 'usdttrc20',
                'ipn_callback_url'      => route('payment.webhook'),
                'order_id'              => 'DEP_'.auth()->id().'_'.time(),
                'order_description'     => 'Deposit for '.auth()->user()->email,
                'success_url'           => route('payment.success'),
                'cancel_url'            => route('payment.cancel'),
                'is_fixed_rate'         => true,
                'is_fee_paid_by_user'   => true
            ];
            Log::debug('NOWPayments Request Payload', $payload);

            $response = Http::withHeaders([
                'x-api-key' => $this->api_key,
                'Content-Type' => 'application/json'
            ])->timeout(30)->post('https://api.nowpayments.io/v1/payment', $payload);

            $responseData = $response->json();
            Log::debug('NOWPayments Raw Response', $responseData);

            // Debug: Check what's actually being returned
            if (app()->environment('local')) {
                dd($responseData); // Only in local development
            }

            if (!$response->successful()) {
                $error = $responseData['message'] ?? json_encode($responseData);
                throw new \Exception("API Error: {$error}");
            }

            // Check for alternative URL fields if invoice_url is missing
            $redirectUrl = $responseData['invoice_url']
                         ?? $responseData['pay_url']
                         ?? $responseData['payment_url']
                         ?? null;

            if (!$redirectUrl) {
                throw new \Exception("No payment URL found in response. Response: ".json_encode($responseData));
            }

            // Create transaction record
            InTransition::create([
                'uid' => auth()->id(),
                'transaction_type' => 'deposit',
                'transaction_amount' => $request->transaction_amount,
                'order_id' => $payload['order_id'],
                'payment_id' => $responseData['payment_id'] ?? 'pending_'.str::random(8),
                'status' => 0,
                'wallet_address' => $responseData['pay_address'] ?? null,
                'crypto_amount' => $responseData['pay_amount'] ?? null,
                'meta' => json_encode($responseData)
            ]);

            return redirect()->away($redirectUrl);

        } catch (\Exception $e) {
            Log::error('NOWPayments Error: '.$e->getMessage(), [
                'user' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Payment failed: '.$e->getMessage());
        }
    }

    // Webhook to auto-update status
    public function handleWebhook(Request $request)
    {
        $data = $request->all();
        Log::error('NOWPayments Error: '.$e->getMessage(), [
                'user' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);
        if ($data['payment_status'] === 'finished') {
            // Match user by order_id or custom ID
            $orderId = $data['order_id'];

            // Example: find deposit by order ID
            $inTransaction = InTransition::where('order_id', $orderId)->first();

            if ($inTransaction && $inTransaction->status !== 1) {
                $inTransaction->status            = 1;
                $inTransaction->transaction_id    = $data['payment_id'];
                $inTransaction->save();

                // Optional: credit user balance
                $this->success_deposit($inTransaction);
            }
        }

        return response('OK');
    }


    public function success_deposit($inTransaction)
    {
        // return $inTransaction;

        $uid = $inTransaction->uid;
        $total_num_of_deposit   = InTransition::where(['transaction_type'=>'deposit','uid'=>$uid])->count();
        $account_statement      =  AccountStatement::where('uid', $uid)->first();
        $user = User::where('uid', $uid)->first();
        $transaction_amount = $inTransaction->transaction_amount;
        /* if ($inTransaction->transaction_amount !=  $transaction_amount)
        {
            $transaction_fee = ServiceFees::where('transaction_type', 1)->first()->fees;

            $charge = number_format( $transaction_amount *  ( $transaction_fee/100 ),2 );

            // $subtotal = $charge + $transaction_amount;
            $inTransaction->subtotal = $inTransaction->subtotal;
            $inTransaction->transaction_amount = $transaction_amount;
            $inTransaction->transaction_fee = $charge;
        } */
        // insert data into AccountTransaction table
        $deposit_amount = $inTransaction->transaction_amount;
        session()->put('deposit_amount', $deposit_amount);
        session()->put('s_user_name', $user->name);
        AccountTransaction::insert([
            'uid'               => $uid,
            'old_balance'       => $account_statement->balance,
            // 'transaction_id' => $inTransaction->transaction_id,
            'transaction_type'  => 1,
            'transaction_amount'=> $deposit_amount,
            'transaction_fee'   => $inTransaction->transaction_fee,
            // 'wallet_address' => $inTransaction->wallet_address,
            'subtotal'          => $inTransaction->subtotal,
            'current_balance'   => $account_statement->balance + $deposit_amount,
            'created_at'        => Carbon::now(),
        ]);
        // update account_statement
        $account_statement->total_deposite  += $deposit_amount;
        $account_statement->balance         += $deposit_amount;
        $account_statement->save();
        // update inTransaction table status
        $inTransaction->status = 1;
        $inTransaction->save();

        // Referal Profit  for CEO / Marchents
        $ref_user = User::where(['uid'=>$uid])->first(['reference']) ;
        $ref_uid  = $ref_user->reference;
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
                'uid'                   => $ceo_uid,
                'team_member_uid'       =>  $uid,
                'profit'                => $bonus_amount ,
                'team_member_profit'    => $deposit_amount,
                'profit_ratio'          => $bonus_ratio,
                'genaration'            => 9, // marchents/ceo
                'created_at'            => Carbon::now(),
            ]);
            $account_statement_ceo = AccountStatement::where('uid', $ceo_uid)->first();
            $account_statement_ceo->balance     = $account_statement_ceo->balance +  $bonus_amount ;
            $account_statement_ceo->team_income = $account_statement_ceo->team_income +  $bonus_amount ;
            $account_statement_ceo->save();
        }

        $user->notify(new DepositNotification);
        session()->forget('deposit_amount');
        session()->forget('s_user_name');
        // return back()->with('success', 'Success');

    }
}
