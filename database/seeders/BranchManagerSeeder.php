<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BranchManager;

class BranchManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approver1User = User::where('role', 'approver1')->first();

        // Create branch managers linked to users
        BranchManager::create([
            'Name' => 'John Doe',
            'PositionID' => 1,
            'BranchID' => 1,
            'PhoneNumber' => '1234567890',
            'UserID' => $approver1User->id, // Link to admin user ID
        ]);
    }
}
