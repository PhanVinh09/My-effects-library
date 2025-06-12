<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'PhanVinh',
            'email' => '',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'membership_level' => 'VIP'
        ]);
        DB::table('users')->insert([
            'name' => 'BaoTram',
            'email' => '',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'membership_level' => 'Normal'
        ]);
    }
}
