<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_groups')->insert([
            'name' => '10yroグループ',
        ]);
        DB::table('company_groups')->insert([
            'name' => '株式会社Aグループ',
        ]);
        DB::table('company_groups')->insert([
            'name' => '株式会社B',
        ]);
        DB::table('company_groups')->insert([
            'name' => '株式会社C',
        ]);
    }
}