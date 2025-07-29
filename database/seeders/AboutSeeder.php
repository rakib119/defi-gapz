<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->delete();
        $about = [
            ['photo' => 'logo.png', 'description' => 'write your description'],
        ];
        DB::table('abouts')->insert($about);
    }
}
