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
            'cooperation_password' => 'pass',
            'push_notification' => 'PUSH通知のお知らせ002',
            'info_page_url' => 'https://example.com/info',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 2,
            'api_url' => 'https://example.com/api3',
            'cooperation_password' => 'pass',
            'push_notification' => 'PUSH通知のお知らせ003',
            'info_page_url' => 'https://example.com/info',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 3,
            'api_url' => 'https://example.com/api4',
            'cooperation_password' => 'pass',
            'push_notification' => 'PUSH通知のお知らせ004',
            'info_page_url' => 'https://example.com/info',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 4,
            'api_url' => 'https://example.com/api5',
            'cooperation_password' => 'pass',
            'push_notification' => 'PUSH通知のお知らせ005',
            'info_page_url' => 'https://example.com/info',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 5,
            'api_url' => 'https://example.com/api5',
            'cooperation_password' => 'pass',
            'push_notification' => 'PUSH通知のお知らせ005',
            'info_page_url' => 'https://example.com/info',
        ]);
        DB::table('company_settings')->insert([
            'company_id' => 6,
            'api_url' => 'http://192.168.0.100/notifier/apis/notification',
            'cooperation_password' => 'P@ssw0rd',
            'push_notification' => '災害または地震のお知らせです。',
            'info_page_url' => 'https://example.com/info',
        ]);
    }
}