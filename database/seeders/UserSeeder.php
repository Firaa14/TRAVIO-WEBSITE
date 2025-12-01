<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo user
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'),
            'phone' => '08123456789',
            'role' => 'user',
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@travio.com',
            'password' => Hash::make('admin123'),
            'phone' => '08111222333',
            'role' => 'admin',
        ]);

        // Create additional test users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'phone' => '08234567890',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'phone' => '08345678901',
            'role' => 'user',
        ]);

        $this->command->info('Users seeded successfully!');
        $this->command->info('Demo credentials:');
        $this->command->info('Email: demo@example.com | Password: password');
        $this->command->info('Admin: admin@travio.com | Password: admin123');
    }
}