<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@sportease.com'], // Ensure only one admin account exists
            [
                'name' => 'Super Admin',
                'email' => 'admin@sportease.com',
                'password' => Hash::make('admin123'), // Make sure it's hashed
                'type' => 2, // ✅ Set type = 2 for admin
            ]
        );
    }
}
