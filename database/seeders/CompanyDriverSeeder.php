<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyDriver;

class CompanyDriverSeeder extends Seeder
{
    public function run(): void
    {
        $drivers = [];

        for ($i = 1; $i <= 10; $i++) {
            $drivers[] = [
                'Name' => $this->generateRandomName(),
                'PhoneNumber' => $this->generateRandomPhoneNumber(),
            ];
        }

        CompanyDriver::insert($drivers);
    }


    private function generateRandomName(): string
    {
        $firstNames = ['John', 'Jane', 'Michael', 'Emily', 'David', 'Emma', 'James', 'Olivia', 'Daniel', 'Sophia'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Taylor', 'Anderson'];

        $firstName = $firstNames[array_rand($firstNames)];
        $lastName = $lastNames[array_rand($lastNames)];

        return $firstName . ' ' . $lastName;
    }

    private function generateRandomPhoneNumber(): string
    {
        return '08' . rand(100000000, 999999999);
    }
}
