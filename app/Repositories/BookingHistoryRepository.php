<?php

namespace App\Repositories;

use App\Models\BookingHistory;
use App\Interfaces\BookingHistoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookingHistoryRepository implements BookingHistoryRepositoryInterface
{
    public function create(array $data)
    {
        return BookingHistory::create($data);
    }

    public function getByBooking($bookingID)
    {
        return BookingHistory::where('booking_id', $bookingID)->get();
    }

    public function store(array $bookingData)
    {
        return $this->create([
            'BookingID' => $bookingData['BookingID'],
            'ReturnDate' => now(),
            'LastOdometerReading' => $bookingData['LastKM'],
            'FuelUsed' => $bookingData['FuelConsumption'],
            'BookingStatus' => 'Completed',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function getHistoryBooking()
    {
        $History = DB::table('booking_histories')
            ->join('bookings', 'booking_histories.BookingID', '=', 'bookings.BookingID')
            ->join('vehicles', 'bookings.VehicleID', '=', 'vehicles.VehicleID')
            ->join('company_drivers', 'bookings.DriverID', '=', 'company_drivers.DriverID')
            ->select('bookings.BookerName', 'vehicles.VehicleType', 'company_drivers.Name', 'booking_histories.ReturnDate', 'booking_histories.LastOdometerReading', 'booking_histories.FuelUsed', 'booking_histories.BookingStatus')
            ->get();

        return $History;
    }
}
