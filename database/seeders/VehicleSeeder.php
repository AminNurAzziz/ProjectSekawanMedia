<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'VehicleID' => 1,
                'VehicleModel' => 'Toyota Camry',
                'VehicleType' => 'Passenger',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 10.5,
                'ServiceIntervalKM' => 5000,
                'Ownership' => 'Company',
            ],
            [
                'VehicleID' => 2,
                'VehicleModel' => 'Ford F-150',
                'VehicleType' => 'Cargo',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 15.2,
                'ServiceIntervalKM' => 7000,
                'Ownership' => 'Company',
            ],
            [
                'VehicleID' => 3,
                'VehicleModel' => 'Toyota Corolla',
                'VehicleType' => 'Passenger',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 9.5,
                'ServiceIntervalKM' => 4000,
                'Ownership' => 'Rented',
            ],
            [
                'VehicleID' => 4,
                'VehicleModel' => 'Ford Transit',
                'VehicleType' => 'Cargo',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 12.5,
                'ServiceIntervalKM' => 6000,
                'Ownership' => 'Company',
            ],
            [
                'VehicleID' => 5,
                'VehicleModel' => 'Toyota Sienna',
                'VehicleType' => 'Passenger',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 11.5,
                'ServiceIntervalKM' => 4500,
                'Ownership' => 'Company',
            ],
            [
                'VehicleID' => 6,
                'VehicleModel' => 'Ford E-350',
                'VehicleType' => 'Cargo',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 14.5,
                'ServiceIntervalKM' => 6500,
                'Ownership' => 'Company',
            ],
            [
                'VehicleID' => 7,
                'VehicleModel' => 'Toyota RAV4',
                'VehicleType' => 'Passenger',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 10.5,
                'ServiceIntervalKM' => 5000,
                'Ownership' => 'Rented',
            ],
            [
                'VehicleID' => 8,
                'VehicleModel' => 'Ford Explorer',
                'VehicleType' => 'Cargo',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 15.2,
                'ServiceIntervalKM' => 7000,
                'Ownership' => 'Company',
            ],
            [
                'VehicleID' => 9,
                'VehicleModel' => 'Toyota Highlander',
                'VehicleType' => 'Passenger',
                'VehicleStatus' => 'Available', // fixed missing quote here
                'FuelConsumptionPerKM' => 9.5,
                'ServiceIntervalKM' => 4000,
                'Ownership' => 'Rented',
            ],

            [
                'VehicleID' => 10,
                'VehicleModel' => 'Ford F-250',
                'VehicleType' => 'Cargo',
                'VehicleStatus' => 'Available',
                'FuelConsumptionPerKM' => 12.5,
                'ServiceIntervalKM' => 6000,
                'Ownership' => 'Company',
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::create($vehicleData);
        }
    }
}
