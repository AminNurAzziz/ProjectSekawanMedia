<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'PositionName' => 'Manager',
            ],
            [
                'PositionName' => 'Supervisor',
            ],
            [
                'PositionName' => 'Employee',
            ],
            [
                'PositionName' => 'Assistant Manager',
            ],
            [
                'PositionName' => 'Director',
            ],
        ];

        foreach ($positions as $positionData) {
            Position::create($positionData);
        }
    }
}
