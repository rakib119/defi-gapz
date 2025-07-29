<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositeProfitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fixed_deposite_profits')->delete();
        $now = Carbon::now();
        $datas = [
            ['days' => 1, 'profit' => 0.01,'created_at'=>$now],
            ['days' => 2, 'profit' => 0.03,'created_at'=>$now],
            ['days' => 7, 'profit' => 0.20,'created_at'=>$now],
            ['days' => 15, 'profit' => 0.50,'created_at'=>$now],
            ['days' => 30, 'profit' => 0.58,'created_at'=>$now],
        ];
        DB::table('fixed_deposite_profits')->insert($datas);
    }
}
