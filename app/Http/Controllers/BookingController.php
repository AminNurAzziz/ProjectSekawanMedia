<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\VehicleService;
use App\Http\Controllers\Controller;
use App\Services\BranchManagerService;
use App\Services\CompanyDriverService;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreBookingRequest;
use App\Services\HeadOfficeManagerService;
use App\Http\Requests\ReturnBookingRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected $bookingService;
    protected $vehicleService;
    protected $companyDriverService;
    protected $branchManager;
    protected $headOfficeManager;

    public function __construct(BookingService $bookingService, VehicleService $vehicleService, CompanyDriverService $companyDriverService, BranchManagerService $branchManager, HeadOfficeManagerService $headOfficeManager)
    {
        parent::__construct();
        $this->bookingService = $bookingService;
        $this->vehicleService = $vehicleService;
        $this->companyDriverService = $companyDriverService;
        $this->branchManager = $branchManager;
        $this->headOfficeManager = $headOfficeManager;
    }

    public function index()
    {
        try {
            $bookings = $this->bookingService->index();

            $this->logService->createLog('Fetched bookings successfully', 'fetch');
            return view('bookings.index', compact('bookings'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch bookings: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch bookings: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $vehicles = $this->vehicleService->index();
            $drivers = $this->companyDriverService->getAllCompanyDrivers();
            $branchManagers = $this->branchManager->getAllBranchManagers();
            $headOfficeManagers = $this->headOfficeManager->getAllHeadOfficeManagers();
            return view('bookings.create', compact('vehicles', 'drivers', 'branchManagers', 'headOfficeManagers'));
        } catch (\Exception $e) {
            Log::error('Failed to load booking creation page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load booking creation page: ' . $e->getMessage());
        }
    }

    public function store(StoreBookingRequest $request)
    {
        $bookingData = $request->validated();
        try {
            $this->bookingService->store($bookingData);
            $this->logService->createLog('Booking created successfully', 'store');
            return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
        } catch (ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return redirect()->route('bookings.create')->with('error', 'Validation error: ' . $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Failed to create booking: ' . $e->getMessage());
            return redirect()->route('bookings.create')->with('error', 'Failed to create booking: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Failed to create booking: ' . $e->getMessage());
            return redirect()->route('bookings.create')->with('error', 'Failed to create booking: ' . $e->getMessage());
        }
    }

    public function updateApproval($id, $bookingStatus)
    {
        try {
            $booking = $this->bookingService->find($id);
            if (!$booking) {
                return response()->json(['message' => 'Booking not found'], 404);
            }
            $this->bookingService->updateApproval($booking, $bookingStatus);
            $this->logService->createLog('Booking updated successfully', 'update');

            return redirect('/approval')->with('success', 'Booking updated successfully');
        } catch (ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return response()->json(['message' => 'Validation error: ' . $e->getMessage()], 422);
        } catch (QueryException $e) {
            Log::error('Failed to update booking: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Failed to update booking: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        }
    }

    public function returnBooking(ReturnBookingRequest $request)
    {
        try {
            $booking = $this->bookingService->getBookingByVehicleID($request->VehicleID);
            $returnData = $request->validated();
            $returnData['BookingID'] = $booking->BookingID;
            $this->bookingService->returnBooking($booking, $returnData);
            $this->logService->createLog('Booking returned successfully', 'update');
            return redirect('/booking-histories')->with('success', 'Booking returned successfully');
        } catch (ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return redirect('/booking-histories')->with('message', 'Validation error: ' . $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Failed to update booking: ' . $e->getMessage());
            return redirect('/booking-histories')->with('message', 'Failed to update booking: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Failed to update booking: ' . $e->getMessage());
            return redirect('/booking-histories')->with('message', 'Failed to update booking: ' . $e->getMessage());
        }
    }
}
