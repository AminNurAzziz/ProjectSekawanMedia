<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'BranchName' => 'Cabang Perushaan A',
                'Address' => '123 Main St',
            ],
            [
                'BranchName' => 'Cabang Perushaan B',
                'Address' => '456 Oak Ave',
            ],
            [
                'BranchName' => 'Cabang Perushaan C',
                'Address' => '789 Elm Blvd',
            ],
            [
                'BranchName' => 'Cabang Perushaan D',
                'Address' => '101 Pine Rd',
            ],
            [
                'BranchName' => 'Cabang Perushaan E',
                'Address' => '222 Cedar Ln',
            ],
            [
                'BranchName' => 'Cabang Perushaan F',
                'Address' => '333 Maple Dr',
            ],
        ];

        foreach ($branches as $branchData) {
            Branch::create($branchData);
        }
    }
}
