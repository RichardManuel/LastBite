<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'city' => 'Jakarta',
            'phone' => '081234567890',
            'password' => Hash::make('password123'), // Jangan lupa ganti di production
            'notes' => 'This is an admin account',
            'roles' => 'admin',
            'status' => 'active',
            'remember_token' => Str::random(10),
            'img_path' => 'uploads/profile/default.png', // atau sesuai kebutuhan
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
