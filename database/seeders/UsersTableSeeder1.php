<?php

use Illuminate\Database\Seeder;

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
    }
}