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
        // Create admin user
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Create approver1 user
        User::create([
            'username' => 'approver1_user',
            'email' => 'approver1@example.com',
            'password' => bcrypt('password'),
            'role' => 'approver1'
        ]);

        // Create approver2 user
        User::create([
            'username' => 'approver2_user',
            'email' => 'approver2@example.com',
            'password' => bcrypt('password'),
            'role' => 'approver2'
        ]);
    }
}
