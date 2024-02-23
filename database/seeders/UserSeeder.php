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
            'name' => 'Mr Franky',
            'username' => 'franky',
            'role_id' => 1,
            'phone' => '09791652876',
            'email' => 'franky@gmail.com',
            'email_verified_at' => now(),
            'address' => 'No-22 Yangon',
            'password' => Hash::make('adminPassword123'),
            'gender' => 1,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
