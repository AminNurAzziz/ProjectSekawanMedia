<?php

namespace App\Services;

use App\Interfaces\BookingHistoryRepositoryInterface;

class BookingHistoryService
{
    protected $bookingHistoryRepository;

    public function __construct(BookingHistoryRepositoryInterface $bookingHistoryRepository)
    {
        $this->bookingHistoryRepository = $bookingHistoryRepository;
    }

    public function getHistoryBooking()
    {
        return $this->bookingHistoryRepository->getHistoryBooking();
    }
}
