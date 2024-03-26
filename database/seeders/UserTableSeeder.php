<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = [
            'name' => 'User',
            'username' => 'User',
            'email' => 'user@app.com',
            'role' => 'user',
            'status' => 'active',
            'password' => bcrypt('123456')

        ];

        DB::table('users')->insert($user);
    }
}
