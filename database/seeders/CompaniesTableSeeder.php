<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'company_cd' => '10yro001',
            'name' => '10yro001支店',
            'company_group_id' => 1,

        ]);
        DB::table('companies')->insert([
            'company_cd' => '10yro002',
            'name' => '10yro002支店',
            'company_group_id' => 1,
        ]);
        DB::table('companies')->insert([
            'company_cd' => '10yro003',
            'name' => '10yro003支店',
            'company_group_id' => 1,
        ]);
        DB::table('companies')->insert([
            'company_cd' => '10yro004',
            'name' => '10yro004支店',
            'company_group_id' => 1,
        ]);
        DB::table('companies')->insert([
            'company_cd' => 'A001',
            'name' => 'A001支店',
            'company_group_id' => 2,
        ]);
        DB::table('companies')->insert([
            'company_cd' => '10yro',
            'name' => '10yro',
            'company_group_id' => 1,
        ]);
    }
}