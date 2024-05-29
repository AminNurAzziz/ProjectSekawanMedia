<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\BranchManager;
use App\Models\Vehicle;
use App\Models\CompanyDriver;
use App\Models\HeadOfficeManager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'BookerName' => $this->faker->name,
            'VehicleID' => Vehicle::factory()->create()->VehicleID, // Menggunakan Vehicle::factory()->create() untuk membuat record baru dan mengambil VehicleID-nya
            'DriverID' => CompanyDriver::factory()->create()->DriverID, // Menggunakan CompanyDriver::factory()->create() untuk membuat record baru dan mengambil DriverID-nya
            'BookingDate' => $this->faker->date(),
            'BranchManagerApproval' => $this->faker->boolean(),
            'HeadOfficeManagerApproval' => $this->faker->boolean(),
            'BranchManagerID' => BranchManager::factory()->create()->ManagerID, // Menggunakan Branch::factory()->create() untuk membuat record baru dan mengambil BranchManagerID-nya
            'HeadOfficeManagerID' => HeadOfficeManager::factory()->create()->HeadManagerID, // Menggunakan HeadOfficeManager::factory()->create() untuk membuat record baru dan mengambil HeadOfficeManagerID-nya
        ];
    }
}
