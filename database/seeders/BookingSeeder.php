<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 7; $i++) {
            $booking = Booking::create([
                'BookerName' => 'John Doe' . $i,
                'VehicleID' => $i,
                'DriverID' => 1,
                'BookingDate' => now(),
                'BranchManagerID' => 1,
                'HeadOfficeManagerID' => 1,
            ]);

            if ($i <= 5) {
                $booking->BookingStatus = 'Approved';
            } elseif ($i <= 8) {
                $booking->BookingStatus = 'Pending';
            } else {
                $booking->BookingStatus = 'Rejected';
            }


            $booking->save();
        }
    }
}
