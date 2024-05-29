<?php

namespace Database\Factories;

use App\Models\BranchManager;
use App\Models\Position;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BranchManager>
 */
class BranchManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BranchManager::class;
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name,
            'PositionID' => Position::factory(),
            'BranchID' => Branch::factory(),
            'PhoneNumber' => $this->faker->numerify('##########'),
        ];
    }
}
