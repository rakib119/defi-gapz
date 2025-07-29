<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uid1 =  Str::random(16);
        $uid2 =  Str::random(16);
        $uid3 =  Str::random(16);
        $uid4 =  Str::random(16);
        $uid5 =  Str::random(16);
        $time = Carbon::now();
        $password = Hash::make('?password?');

        DB::table('users')->delete();
        DB::table('account_statements')->delete();


        $users = [
            ['uid'=>  '112233445566', 'wallet_address'=>  '112233445566', 'name' =>"Admin",  'email' => 'rakibh01739@gmail.com',  'mobile'=>rand(11111111111,99999999999), 'role' => 1, 'email_verified_at'=>$time,'password' => Hash::make('password'),'transaction_password' => Hash::make('password'),'reference'=>null,'created_at'=>$time],
            ['uid'=>  $uid1, 'wallet_address'=>  $uid1, 'name' =>"Admin",  'email' => 'admin@p2p.com',  'mobile'=>rand(11111111111,99999999999), 'role' => 1, 'email_verified_at'=>$time,'password' => $password,'transaction_password' => $password,'reference'=>null,'created_at'=>$time],
            ['uid'=>  $uid2, 'wallet_address'=>  $uid2, 'name' =>"Admin2", 'email' => 'admin2@p2p.com', 'mobile'=>rand(11111111111,99999999999), 'role' => 1, 'email_verified_at'=>$time,'password' => $password,'transaction_password' => $password,'reference'=>null,'created_at'=>$time],
            ['uid'=>  $uid3, 'wallet_address'=>  $uid3, 'name' =>"CEO", 'email' => 'ceo@gmail.com', 'mobile'=>rand(11111111111,99999999999), 'role' => 2, 'email_verified_at'=>$time,'password' => $password,'transaction_password' => $password,'reference'=>null,'created_at'=>$time],
            ['uid'=>  $uid4, 'wallet_address'=>  $uid4, 'name' =>"Saif", 'email' => 'dewanmridha@gmail.com', 'mobile'=>rand(11111111111,99999999999), 'role' => 1, 'email_verified_at'=>$time,'password' => Hash::make('12121212'),'transaction_password' => $password,'reference'=>null,'created_at'=>$time],
            ['uid'=>  $uid5, 'wallet_address'=>  $uid5, 'name' =>"Admin",  'email' => 'user@gmail.com',  'mobile'=>rand(11111111111,99999999999), 'role' => 0, 'email_verified_at'=>$time,'password' => $password,'transaction_password' => $password,'reference'=>$uid3,'created_at'=>$time],
        ];

        $accounts = [
            [ 'uid'=>  '112233445566', 'balance' => 1000.00, 'created_at'=>$time ],
            [ 'uid'=>  $uid1, 'balance' => 100.00, 'created_at'=>$time ],
            [ 'uid'=>  $uid2, 'balance' => 100.00, 'created_at'=>$time ],
            [ 'uid'=>  $uid3, 'balance' => 100.00, 'created_at'=>$time ],
            [ 'uid'=>  $uid4, 'balance' => 100.00, 'created_at'=>$time ],
            [ 'uid'=>  $uid5, 'balance' => 100.00, 'created_at'=>$time ]
        ];


        DB::table('users')->insert($users);
        DB::table('account_statements')->insert($accounts);


    }
}
