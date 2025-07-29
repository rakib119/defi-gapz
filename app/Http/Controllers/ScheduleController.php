<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\competitionTransitionDetail;
use App\Models\EarnFromInvestment;
use App\Models\InTransition;
use App\Models\TeamIncome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{
     public function compititionSchedular(){
        $now  = Carbon::now();
        $InTransition =  InTransition::where([
            'transaction_type' => 'competition',
            'status' => 0
        ])
        ->where('created_at','<=',$now->subHours(3))
        ->get();

        if ($InTransition->count() > 0) {
            foreach ($InTransition as $value) {
                $account_statement = AccountStatement::where('uid', $value->uid)->first();
                $old_balance = $account_statement->balance;

                $competitionTransition = competitionTransitionDetail::where('order_no', $value->transaction_id)->first();
                $transaction_amount = $competitionTransition->order_amount;
                $profit = $competitionTransition->profit;
                $subtotal = $transaction_amount + $profit;
                $current_balance = $old_balance + $subtotal;
                $created_at = $competitionTransition->created_at;

                AccountTransaction::insert([
                    'uid' => $value->uid,
                    'old_balance' => $old_balance,
                    'transaction_id' =>  $value->transaction_id,
                    'transaction_type' =>  5,
                    'transaction_amount' => $transaction_amount,
                    'profit' =>  $profit,
                    'subtotal' => $subtotal,
                    'current_balance' => $current_balance,
                    'created_at' => $created_at,
                ]);
                $account_statement->balance = $current_balance;
                $account_statement->balance = $current_balance;
                $account_statement->save();
                $value->delete();
            }
        }
     }
     public function compititionSchedular2(){
        $threeHoursAgo = now()->subHours(3);

        $inTransitions = InTransition::where([
                'transaction_type' => 'competition',
                'status' => 0
            ])
            ->where('created_at', '<=', $threeHoursAgo)
            ->get();
        if ($inTransitions->isNotEmpty())
        {
            $uids = $inTransitions->pluck('uid');
            $transactionIds = $inTransitions->pluck('transaction_id');

            $accountStatements = AccountStatement::whereIn('uid', $uids)->get()->keyBy('uid');

            $competitionTransitionDetails = competitionTransitionDetail::whereIn('order_no', $transactionIds)->select('order_no', 'order_amount', 'profit', 'created_at')->get()->keyBy('order_no');

            $accountTransactions = [];

            foreach ($inTransitions as $inTransition) {
                $accountStatement = $accountStatements[$inTransition->uid];
                $oldBalance = $accountStatement->balance;

                $competitionTransition = $competitionTransitionDetails[$inTransition->transaction_id];
                $transactionAmount = $competitionTransition->order_amount;
                $profit = $competitionTransition->profit;
                $subtotal = $transactionAmount + $profit;
                $currentBalance = $oldBalance + $subtotal;
                $createdAt = $competitionTransition->created_at;

                $accountTransactions[] = [
                    'uid' => $inTransition->uid,
                    'old_balance' => $oldBalance,
                    'transaction_id' => $inTransition->transaction_id,
                    'transaction_type' => 5,
                    'transaction_amount' => $transactionAmount,
                    'profit' => $profit,
                    'subtotal' => $subtotal,
                    'current_balance' => $currentBalance,
                    'created_at' => $createdAt,
                ];

                $accountStatement->balance = $currentBalance;
                $accountStatement->save();
            }

            AccountTransaction::insert($accountTransactions);

            InTransition::whereIn('transaction_id', $transactionIds)->delete();
        }
     }
     public function investmentSchedular(){
        $now = Carbon::now();
        $records = DB::table('earn_from_investments','a')
                    ->where(function($query)
                        {
                            $query->where('a.status','=',0)
                                  ->whereRaw("a.created_at <= DATE_SUB(NOW(), INTERVAL a.no_of_days*24 HOUR)- INTERVAL 3 MINUTE");
                        }
                    )
                    ->join('account_statements as b','b.uid','=','a.uid')
                    ->select(['a.id','a.uid','a.transaction_id','a.investment_amount','a.total_profit','a.sub_total','b.id as account_id','b.balance','b.total_investment'])
                    ->get();
        DB::beginTransaction();
        $IQ1 = $UQ1 = $UQ2 = 1;
        $AccountTransactionData=[];
        foreach ($records as $record) {
            $balance = $record->balance ;
            $account_id = $record->account_id ;
            $subTotal = $record->sub_total;
            $profit =  $record->total_profit;
            $investment_amount = $record->investment_amount;
            $AccountTransactionData[] = [
                'uid' => $record->uid,
                'old_balance' => $balance,
                'transaction_type' => 4,
                'transaction_id' => $record->transaction_id,
                'transaction_amount' =>  $investment_amount,
                'profit' => $profit,
                'subtotal' => $subTotal,
                'current_balance' => $balance + $subTotal,
                'status' =>1,
                'created_at' => $now,
            ];
            $UQ1=  DB::table('account_statements')
                ->where('id',$account_id)
                ->update([
                    'balance' => DB::raw('balance+'.$subTotal),
                    'total_investment' => DB::raw('total_investment+'.$investment_amount),
                    'investment_profit' => DB::raw('investment_profit+'.$profit),
                    'updated_at' =>  $now
                ]);

        }
        $IQ1 = DB::table('account_transactions')->insert($AccountTransactionData);
        $UQ2 = DB::table('earn_from_investments')->whereIn('id', $records->pluck('id'))->update(['status' => 1,'updated_at' =>  $now]);

        if ($IQ1 &&  $UQ1 && $UQ2) {
             DB::commit();
             return true;
            //  echo "success";
        }else{
            DB::rollBack();
            return false;
            // echo "faild";
        }

     }
     public function teamIncomeScheduler(){
        $todays_profited_account = AccountTransaction::where('profit', '>', 0.00)->whereDate('created_at', today());
            $uids =  $todays_profited_account->select('uid')->groupBY('uid')->get();
            foreach ($uids as  $uid) {
                $profit = AccountTransaction::where('uid', $uid->uid)->sum('profit');
                $profit_ratio_gen1 = 15;
                $profit_ratio_gen2 = 10;
                $profit_ratio_gen3 = 5;
                $profit_1st_gen = $profit * ($profit_ratio_gen1 / 100);
                $profit_2nd_gen = $profit * ($profit_ratio_gen2 / 100);
                $profit_3rd_gen = $profit * ($profit_ratio_gen3 / 100);
                $gen1 = User::where('uid', $uid->uid)->select('reference')->first();
                if ($gen1->reference) {
                    // 1st gen profit
                    TeamIncome::insert([
                        'uid' => $gen1->reference,
                        'team_member_uid' => $uid->uid,
                        'profit' => $profit_1st_gen,
                        'team_member_profit' => $profit,
                        'profit_ratio' => $profit_ratio_gen1,
                        'genaration' => 1,
                        'created_at' => Carbon::now(),
                    ]);
                    $account_statement_gen1 = AccountStatement::where('uid', $gen1->reference)->first();
                    $account_statement_gen1->balance = $account_statement_gen1->balance +  $profit_1st_gen;
                    $account_statement_gen1->team_income = $account_statement_gen1->team_income +  $profit_1st_gen;
                    $account_statement_gen1->save();

                    $gen2 = User::where('uid', $gen1->reference)->select('reference')->first();

                    if ($gen2->reference) {
                        // 2nd gen profit
                        TeamIncome::insert([
                            'uid' => $gen2->reference,
                            'team_member_uid' => $uid->uid,
                            'profit' => $profit_2nd_gen,
                            'team_member_profit' => $profit,
                            'profit_ratio' => $profit_ratio_gen2,
                            'genaration' => 2,
                            'created_at' => Carbon::now(),
                        ]);
                        $account_statement_gen2 = AccountStatement::where('uid', $gen2->reference)->first();
                        $account_statement_gen2->balance = $account_statement_gen2->balance +  $profit_2nd_gen;
                        $account_statement_gen2->team_income = $account_statement_gen2->team_income +  $profit_2nd_gen;
                        $account_statement_gen2->save();
                        $gen3 = User::where('uid', $gen2->reference)->select('reference')->first();

                        if ($gen3->reference) {
                            // 3rd gen profit
                            TeamIncome::insert([
                                'uid' => $gen3->reference,
                                'team_member_uid' => $uid->uid,
                                'profit' => $profit_3rd_gen,
                                'team_member_profit' => $profit,
                                'profit_ratio' => $profit_ratio_gen3,
                                'genaration' => 3,
                                'created_at' => Carbon::now(),
                            ]);
                            $account_statement_gen3 = AccountStatement::where('uid', $gen3->reference)->first();
                            $account_statement_gen3->balance = $account_statement_gen3->balance +  $profit_3rd_gen;
                            $account_statement_gen3->team_income = $account_statement_gen3->team_income +  $profit_3rd_gen;
                            $account_statement_gen3->save();
                        }
                    }
                }
            }
     }
     public function create_user(){

        $uid=  Str::random(16);
        $time = Carbon::now();
        $password = Hash::make('?password?');
        $users = [
            ['uid'=>  $uid, 'wallet_address'=>  $uid, 'name' =>$uid,  'email' => $uid.'@p2p.com',  'mobile'=>rand(11111111111,99999999999), 'role' => 0, 'email_verified_at'=>$time,'password' => $password,'transaction_password' => $password,'created_at'=>$time],

        ];

        $accounts = [
            [ 'uid'=>  $uid, 'balance' => 100.00, 'created_at'=>$time ],
        ];
        DB::table('users')->insert($users);
        DB::table('account_statements')->insert($accounts);

     }

}
