<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecretQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secret_questions')->delete();
        $secret_questions = [
            ['question' => 'Your Home town?'],
            ['question' => 'Your favorite pet?'],
            ['question' => 'Your favorite holiday location?'],
            ['question' => 'Your favorite person?'],
            ['question' => 'Your primary school name?'],
        ];
        DB::table('secret_questions')->insert($secret_questions);
    }
}
