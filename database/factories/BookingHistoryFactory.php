<?php

namespace Database\Factories;

use App\Models\BookingHistory;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingHistory>
 */
class BookingHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BookingHistory::class;
    public function definition(): array
    {
        return [
            'BookingID' => Booking::factory(),
            'ReturnDate' => $this->faker->date(),
            'LastOdometerReading' => $this->faker->numberBetween(1000, 50000),
            'FuelUsed' => $this->faker->randomFloat(2, 10, 100),
            'BookingStatus' => $this->faker->randomElement(['Completed', 'Cancelled']),
        ];
    }
}
