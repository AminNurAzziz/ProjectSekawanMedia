<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnBookingRequest;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Requests\ReturnVehicleRequest;
use App\Services\BookingService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(StoreBookingRequest $request)
    {
        try {
            $bookingData = $request->validated();
            $this->bookingService->store($bookingData);

            return response()->json(['message' => 'Booking created successfully'], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error: ' . $e->getMessage()], 422);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to create booking: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create booking: ' . $e->getMessage()], 500);
        }
    }

    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        //
    }

    public function updateApproval($id)
    {
        try {
            $booking = $this->bookingService->find($id);
            if (!$booking) {
                return response()->json(['message' => 'Booking not found'], 404);
            }
            $this->bookingService->updateApproval($booking);

            return response()->json(['message' => 'Booking updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error: ' . $e->getMessage()], 422);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        }
    }

    public function returnBooking(ReturnBookingRequest $request)
    {
        try {
            // Mendapatkan objek Booking dari basis data berdasarkan VehicleID
            $booking = $this->bookingService->getBookingByVehicleID($request->VehicleID);

            // Memanggil metode returnBooking dengan objek Booking dan data yang diperlukan
            $returnData = $request->validated();
            $returnData['BookingID'] = $booking->BookingID; // Memasukkan BookingID ke dalam data
            $this->bookingService->returnBooking($booking, $returnData);

            return response()->json(['message' => 'Booking updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error: ' . $e->getMessage()], 422);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        }
    }





    public function destroy(Booking $booking)
    {
        //
    }
}
