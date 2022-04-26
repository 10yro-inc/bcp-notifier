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
            'group_cd' => '001',
        ]);
        DB::table('company_groups')->insert([
            'name' => '株式会社Aグループ',
            'group_cd' => '002',
        ]);
        DB::table('company_groups')->insert([
            'name' => '株式会社B',
            'group_cd' => '003',
        ]);
        DB::table('company_groups')->insert([
            'name' => '株式会社C',
            'group_cd' => '004',
        ]);
    }
}