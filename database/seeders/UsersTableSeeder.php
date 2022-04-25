<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '10yro',
            'user_cd' => '10yro',
            'company_group_id' => 0,
            'password' => bcrypt('P@ssw00rd'),
        ]);

        DB::table('users')->insert([
            'name' => '管理者',
            'user_cd' => 'admin',
            'password' => bcrypt('P@ssw00rd'),
            'company_group_id' => 1,
            'is_super' => true,
        ]);
        DB::table('users')->insert([
            'name' => '10yro_a',
            'user_cd' => '10yro_a',
            'company_group_id' => 2,
            'password' => bcrypt('P@ssw00rd'),
        ]);
    
    }
}