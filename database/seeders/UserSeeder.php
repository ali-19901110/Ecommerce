<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a dummy admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Change this to a secure password
            ]
        );

        // Attach the "admin" role if not already attached
        if (!$admin->hasRole('admin')) {
            $admin->attachRole('admin'); // You can pass the role name directly
        }

        // Optionally create a dummy regular user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
            ]
        );

        if (!$user->hasRole('user')) {
            $user->attachRole('user');
        }
    }
}
