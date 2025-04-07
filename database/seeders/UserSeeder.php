<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user with email and password
        User::create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'name' => 'Test User',  // Add the 'name' field
        ]);
    }
}
