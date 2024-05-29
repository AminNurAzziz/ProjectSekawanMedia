<?php

namespace Database\Factories;

use App\Models\HeadOfficeManager;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HeadOfficeManager>
 */
class HeadOfficeManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = HeadOfficeManager::class;
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name,
            'PositionID' => Position::factory(),
            'PhoneNumber' => $this->faker->numerify('##########'),
        ];
    }
}
