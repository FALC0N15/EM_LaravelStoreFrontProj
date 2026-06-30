<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'              => 'Admin User',
            'email'             => 'admin@themart.test',
            'password'          => Hash::make('password'),
            'is_admin'          => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name'              => 'Evan Maltby',
            'email'             => 'evan@themart.test',
            'password'          => Hash::make('password'),
            'is_admin'          => false,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name'              => 'Test Customer',
            'email'             => 'customer@themart.test',
            'password'          => Hash::make('password'),
            'is_admin'          => false,
            'email_verified_at' => now(),
        ]);
    }
}
