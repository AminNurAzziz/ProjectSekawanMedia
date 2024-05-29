<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vehicle::class;
    public function definition(): array
    {
        return [
            'VehicleID' => $this->faker->unique()->randomNumber(8),
            'VehicleModel' => $this->faker->randomElement(['SUV', 'Sedan', 'Truck']),
            'VehicleType' => $this->faker->randomElement(['Cargo', 'Passenger']),
            'VehicleStatus' => $this->faker->randomElement(['Available', 'Booked', 'On-Trip', 'Under-Maintenance']),
            'FuelConsumptionPerKM' => $this->faker->randomFloat(2, 5, 15),
            'ServiceIntervalKM' => $this->faker->numberBetween(5000, 20000),
            'Ownership' => $this->faker->randomElement(['Company', 'Rented']),
        ];
    }
}
