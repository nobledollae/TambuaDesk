<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'John Technician',
            'email' => 'john@example.com',
            'role' => 'technician',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Mary Technician',
            'email' => 'mary@example.com',
            'role' => 'technician',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Noble Employee',
            'email' => 'noble@example.com',
            'role' => 'employee',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Test Employee',
            'email' => 'test@example.com',
            'role' => 'employee',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);
    }
}