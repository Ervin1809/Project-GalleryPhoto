<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\UserRole;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔄 Creating users...');

        // Clear existing users (optional)
        // User::truncate();

        // ===== ADMIN =====
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Gallery',
                'password' => Hash::make('password'),
                'role' => UserRole::ADMIN,
            ]
        );
        $this->command->info('✅ Admin created:  admin@gmail.com / password');

        // ===== USER BIASA (Default) =====
        User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Regular',
                'password' => Hash::make('password'),
                'role' => UserRole::USER,
            ]
        );
        $this->command->info('✅ User created: user@gmail.com / password');

        // ===== BUAT 30 USER TAMBAHAN =====
        $names = [
            'John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Brown',
            'David Wilson', 'Sarah Davis', 'James Miller', 'Jessica Garcia',
            'Robert Martinez', 'Jennifer Rodriguez', 'William Lopez', 'Linda Lee',
            'Richard Walker', 'Patricia Hall', 'Thomas Allen', 'Barbara Young',
            'Charles King', 'Mary Wright', 'Christopher Scott', 'Susan Green',
            'Daniel Adams', 'Lisa Nelson', 'Matthew Carter', 'Nancy Mitchell',
            'Joshua Perez', 'Karen Roberts', 'Andrew Turner', 'Betty Phillips',
            'Ryan Campbell', 'Sandra Parker',
        ];

        foreach ($names as $index => $name) {
            $email = strtolower(str_replace(' ', '', $name)) . '@example.com';

            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'role' => UserRole:: USER,
                ]
            );
        }

        $this->command->info('✅ Created 30 additional users');
        $this->command->info('📊 Total users: ' . User::count());
    }
}
