<?php

namespace App\Interfaces;

interface BookingHistoryRepositoryInterface
{
    public function create(array $data);
    public function getByBooking($bookingID);
    public function store(array $bookingData);
    public function getHistoryBooking();
}
