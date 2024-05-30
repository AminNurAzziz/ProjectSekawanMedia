<?php

namespace Database\Seeders;

use App\Models\HeadOfficeManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class HeadOfficeManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $approver1User = User::where('role', 'approver2')->first();

        // Create branch managers linked to users
        HeadOfficeManager::create([
            'Name' => 'Jane Doe',
            'PositionID' => 1,
            'PhoneNumber' => '1234567890',
            'UserID' => $approver1User->id, // Link to admin user ID
        ]);
    }
}
