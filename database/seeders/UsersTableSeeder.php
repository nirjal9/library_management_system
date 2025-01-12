<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash; //import hash facade
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  @return void
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password', // Default password
            'role' => 'admin', // Assign admin role
        ]);

        // Create a regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            // 'password' => Hash::make('password'), // Default password
            'password' => 'password', // Default password
            'role' => 'user', // Assign user role
        ]);
    }
}
