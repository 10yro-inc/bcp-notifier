<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_companies')->insert([
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('user_companies')->insert([
            'user_id' => 1,
            'company_id' => 2
        ]);
        DB::table('user_companies')->insert([
            'user_id' => 1,
            'company_id' => 3
        ]);
    }
}