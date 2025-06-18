<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin cố định
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'phone' => '0123456789',
            'address' => 'Admin HQ',
            'role' => 'admin',
        ]);

        // User ngẫu nhiên
        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'), // hoặc fake()->password()
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'role' => 'user',
        ]);
    }
}
