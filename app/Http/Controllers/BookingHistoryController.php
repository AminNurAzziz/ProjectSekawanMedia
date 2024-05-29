<?php

namespace App\Http\Controllers;

use App\Models\BookingHistory;
use App\Http\Requests\StoreBookingHistoryRequest;
use App\Http\Requests\UpdateBookingHistoryRequest;
use App\Services\BookingHistoryService;

class BookingHistoryController extends Controller
{
    protected $bookingHistoryService;

    public function __construct(BookingHistoryService $bookingHistoryService)
    {
        $this->bookingHistoryService = $bookingHistoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getHistoryBooking = $this->bookingHistoryService->getHistoryBooking();
        return response()->json($getHistoryBooking);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingHistory $bookingHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingHistory $bookingHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingHistoryRequest $request, BookingHistory $bookingHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingHistory $bookingHistory)
    {
        //
    }
}
