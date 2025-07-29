<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WithdrawalMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('withdrawal_methods')->delete();
        $withdrawal_methods = [
            ['method_id' => 0, 'method' => 'Tether (TRC20)', 'status' => '1'],
            ['method_id' => 1, 'method' => 'Bank', 'status' => '1']
        ];
        DB::table('withdrawal_methods')->insert($withdrawal_methods);
    }
}
