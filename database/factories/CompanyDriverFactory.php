<?php

namespace Database\Factories;

use App\Models\CompanyDriver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyDriver>
 */
class CompanyDriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CompanyDriver::class;
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name,
            'PhoneNumber' => $this->faker->numerify('##########'),
        ];
    }
}
