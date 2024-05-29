<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BranchManager;
use App\Models\Branch;
use App\Models\CompanyDriver;
use App\Models\HeadOfficeManager;
use App\Models\Position;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\BookingHistory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Branch::factory(10)->create();
        Position::factory(10)->create();
        HeadOfficeManager::factory(10)->create();
        BranchManager::factory(10)->create();
        CompanyDriver::factory(10)->create();
        Vehicle::factory(10)->create();
        // Booking::factory(10)->create();
        // BookingHistory::factory(10)->create();
    }
}
