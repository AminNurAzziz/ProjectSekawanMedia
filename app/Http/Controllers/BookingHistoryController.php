<?php

namespace App\Http\Controllers;

use App\Services\BookingHistoryService;
use Illuminate\Support\Facades\Log;

class BookingHistoryController extends Controller
{
    protected $bookingHistoryService;

    public function __construct(BookingHistoryService $bookingHistoryService)
    {
        parent::__construct();
        $this->bookingHistoryService = $bookingHistoryService;
    }

    public function index()
    {
        try {
            $getHistoryBooking = $this->bookingHistoryService->getHistoryBooking();

            $this->logService->createLog('Fetched booking histories successfully', 'fetch');
            return view('booking-histories.index', compact('getHistoryBooking'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch booking histories: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch booking histories: ' . $e->getMessage());
        }
    }
}
