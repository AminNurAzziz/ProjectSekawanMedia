<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Branch::factory(5)->create();
        // Position::factory(5)->create();
        // HeadOfficeManager::factory(5)->create();
        // BranchManager::factory(5)->create();
        // CompanyDriver::factory(5)->create();
        // Vehicle::factory(5)->create();

        $this->call([
            UserSeeder::class,
            BranchSeeder::class,
            PositionSeeder::class,
            HeadOfficeManagerSeeder::class,
            BranchManagerSeeder::class,
            CompanyDriverSeeder::class,
            VehicleSeeder::class,
            BookingSeeder::class,
            BookingHistorySeeder::class,
        ]);
    }
}
