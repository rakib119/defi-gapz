<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_types')->delete();
        $transaction_types = [
            ['type_id' => 1, 'type' => 'depposite'],
            ['type_id' => 2, 'type' => 'withdraw'],
            ['type_id' => 3, 'type' => 'transfer'],
            ['type_id' => 4, 'type' => 'investment'],
            ['type_id' => 5, 'type' => 'competition'],
        ];
        DB::table('transaction_types')->insert($transaction_types);
    }
}
