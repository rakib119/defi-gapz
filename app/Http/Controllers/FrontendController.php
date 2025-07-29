<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\FixedDepositeProfit;
use App\Models\InTransition;
use App\Models\competitionTransitionDetail;
use App\Models\User;
use App\Notifications\DepositNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    private $videos = ['A3CsreGRnQg','zOlkDer-tCI','YsxlL9pJ-p0'];

    // index
    public function index(Request $request)
    {
        $prices = Http::withHeaders([
            'content-type' => 'application/json',
            'x-api-key' => '121ee80b-370a-42c3-a57c-1c6899423d3b',
        ])->post('https://api.livecoinwatch.com/coins/list', [
            'currency' => 'USD',
            'sort' => 'rank',
            'order' => 'ascending',
            'offset' => 0,
            'limit' => 10,
            'meta' => true // ✅ Include this to get logos
        ]);
        /* $prices = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
            'vs_currency' => 'usd',
            'order' => 'market_cap_desc',
            'per_page' => 10,
            'page' => 1,
            'sparkline' => false
        ]); */
        $prices = json_decode($prices);
        // return $prices;
        if ($request->ajax()) {
            echo (string)  view('partOfFrontend.crypto_pricing',compact('prices'));
        }else{
            return view('frontend.index', [
                'transactions' => AccountTransaction::where('transaction_type', 5)->orderBy('created_at', 'DESC')->take(50)->get(['uid','transaction_amount','profit']),
                'crypto_table'=> view('partOfFrontend.crypto_pricing',compact('prices')),
                'videos'=> $this->videos
            ]);
        }
    } // about
    public function about_us()
    {
        return view('frontend.about', [
            'about' => About::first()
        ]);
    }
    // contact
    public function contact_us()
    {
        return view('frontend.contact');
    }

    // transaction hall page
    public function transaction_hall()
    {
        $auth = auth()->user();
        // return AccountTransaction::where(['uid' => $auth->uid])->whereDate('created_at', today())->get();
        $competetion_list =  competitionTransitionDetail::where('uid', auth()->user()->uid)->whereDate('created_at', today())->orderBy('created_at', 'desc');
        // return $competetion_list->first();
        if ($competetion_list->exists()) {
            $last_competetion_data =  $competetion_list->first();
            $last_insert_time = $last_competetion_data->created_at->diffInMinutes();
            $batch_no = $last_competetion_data->batch_no;
        } else {
            $last_insert_time = 0;
            $batch_no = 0;
        }
        return view('frontend.transaction', [
            'account_statement' => AccountStatement::where('uid', $auth->uid)->first(),
            'in_the_transaction' => InTransition::where(['uid' => $auth->uid, 'status' => 0, 'transaction_type' => 'competition'])->get(),
            'account_transaction' => AccountTransaction::where(['uid' => $auth->uid, 'transaction_type' => 5])->whereDate('created_at', today())->get(),
            'last_competition_time' => $last_insert_time,
            'batch_no' => $batch_no,
        ]);
    }
    // earn_page
    public function view_earn_page()
    {
        $uid = auth()->user()->uid;
        $freez_amount = DB::table('earn_from_investments')
                        ->where([
                            'uid'=>$uid,
                            'status' => 0
                            ])
                        ->sum('investment_amount');
        $histories = DB::table('earn_from_investments')
                    ->where(['uid'=>$uid,'transaction_type'=>'investment'])
                    ->select('id','transaction_id','investment_amount','total_profit','no_of_days','status','created_at')
                    ->take(10)->orderBy('id','desc')->get();

        return view('frontend.earn', [
            'account_statement' => AccountStatement::where('uid', $uid)->first(),
            'account_transaction' => AccountTransaction::where(['uid' => $uid])->whereDate('created_at', today())->get(),
            'freez_amount' => $freez_amount,
            'fixed_deposits' => FixedDepositeProfit::all(),
            'deposit_histories'=> $histories,
        ]);
    }
    // mine_page
    public function view_mine_page()
    {
        $uid = auth()->user()->uid;
        return view('frontend.mine', [
            'account_statement' => AccountStatement::where('uid', $uid)->first(),
            'account_transaction' => AccountTransaction::where(['uid' => $uid])->whereDate('created_at', today())->get(),
        ]);
    }
    // Terms And Conditions
    public function terms_and_cond(){
        return view('frontend.t&c', [
            'about' => About::first()
        ]);
    }
    public function get_user_name(Request $request)
    {
        // $request->validate([
        //     'uid' => 'exists:users,uid'
        // ]);
        $uid = $request->uid;
        $user = User::where('uid', $uid)->first('name');
        echo $user ? $user->name : '';
    }
    public function s()
    {

        return view('email.refund');
        return $AccountTransactions =  AccountTransaction::where(['transaction_type' => 6, 'status' => 0, ['current_balance', '>', 0]])->get();

        foreach ($AccountTransactions as  $AccountTransactions) {

            $AccountTransactions->transaction_type = 6;
            $AccountTransactions->save();
            $trnxAmount = $AccountTransactions->subtotal;
            $uid = $AccountTransactions->uid;
            $account_satement =  AccountStatement::where('uid', $uid)->first();
            $account_satement->balance = $account_satement->balance + $trnxAmount;
            $account_satement->updated_by = auth()->user()->uid;
            $account_satement->save();
            $user = User::where('uid', $uid)->first();
            $user->notify(new DepositNotification);
        }
        return "success";
    }
    function test (Request $request){
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:30', 'unique:users'],
            'reference' => ['nullable', 'exists:users,uid'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tmc' => ['required'],
        ], [
            'reference.exists' => "Reference id is not correct",
            'tmc.required' => "Please aggried with our terms and conditions"
        ]);
        return $request;
    }
    public function privacy_policy(){
        return view('frontend.privacy_policy');
    }
    public function download_center(){
        return view('frontend.download_center');
    }
}
