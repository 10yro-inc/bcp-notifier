<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('company_settings')->insert([
            'company_id' => 1,
            'api_url' => 'https://example.com/api2',
            'push_notification' => 'PUSH通知のお知らせ002',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 2,
            'api_url' => 'https://example.com/api3',
            'push_notification' => 'PUSH通知のお知らせ003',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 3,
            'api_url' => 'https://example.com/api4',
            'push_notification' => 'PUSH通知のお知らせ004',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 4,
            'api_url' => 'https://example.com/api5',
            'push_notification' => 'PUSH通知のお知らせ005',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 5,
            'api_url' => 'https://example.com/api5',
            'push_notification' => 'PUSH通知のお知らせ005',
        ]);
    }
}