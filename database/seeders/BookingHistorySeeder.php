<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\BookingHistory;

class BookingHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Booking::where('BookingStatus', 'Approved')->get();

        foreach ($bookings as $index => $booking) {
            $bookingStatus = ($index % 2 == 0) ? 'On-Trip' : 'Completed';

            BookingHistory::create([
                'BookingID' => $booking->BookingID,
                'BookingStatus' => $bookingStatus,
                'ReturnDate' => now(),
                'LastOdometerReading' => 1000,
                'FuelUsed' => 10.5,
            ]);
        }
    }
}
