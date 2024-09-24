<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_name_en' => 'Admin',
            'user_name_ar' => 'ادمن',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'type' => 'consumer',
            'is_verified' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);
    }
}
