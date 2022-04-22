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
            'password' => bcrypt('P@ssw00rd'),
        ]);

        DB::table('users')->insert([
            'name' => '管理者',
            'user_cd' => 'admin',
            'password' => bcrypt('P@ssw00rd'),
            'is_super' => true,
        ]);
    
    }
}