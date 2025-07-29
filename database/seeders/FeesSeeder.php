<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_fees')->delete();
        $service_fees = [
            ['transaction_type' => 1, 'fees' => 1],
            ['transaction_type' => 2, 'fees' => 1],
            ['transaction_type' => 3, 'fees' => 1],
            ['transaction_type' => 4, 'fees' => 1],
            ['transaction_type' => 5, 'fees' => 1],
        ];
        DB::table('service_fees')->insert($service_fees);
    }
}
