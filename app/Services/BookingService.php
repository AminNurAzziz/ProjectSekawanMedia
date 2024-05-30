<?php

namespace App\Services;

use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\VehicleRepositoryInterface;
use App\Interfaces\BookingHistoryRepositoryInterface;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class BookingService
{
    protected $bookingRepository;
    protected $vehicleRepository;
    protected $BookingHistoryService;

    public function __construct(BookingRepositoryInterface $bookingRepository, VehicleRepositoryInterface $vehicleRepository, BookingHistoryRepositoryInterface $HistoryBookingService)
    {
        $this->bookingRepository = $bookingRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->BookingHistoryService = $HistoryBookingService;
    }

    public function index()
    {
        return $this->bookingRepository->index();
    }

    public function store(array $bookingData)
    {
        $vehicle = $this->vehicleRepository->find($bookingData['VehicleID']);
        if ($vehicle->VehicleStatus !== 'Available') {
            throw new \Exception('Vehicle is not available for booking');
        }

        $vehicle->VehicleStatus = 'Booked';
        $vehicle->save();

        return $this->bookingRepository->create($bookingData);
    }


    public function updateApproval(Booking $booking, $bookingStatus)
    {
        try {
            $role_user = auth()->user()->role;
            $this->bookingRepository->updateApproval($booking, $role_user, $bookingStatus);
            if ($booking->BranchManagerApproval === 'Approved' && $booking->HeadOfficeManagerApproval === 'Approved') {
                $booking->BookingStatus = 'Approved';
                $vehicle = $this->vehicleRepository->find($booking->VehicleID);
                $vehicle->VehicleStatus = 'On-Trip';
                $vehicle->save();

                $this->BookingHistoryService->store([
                    'BookingID' => $booking->BookingID,
                    'LastKM' => $vehicle->LastKM,
                    'FuelConsumption' => 0,
                    'BookingStatus' => 'On-Trip',
                ]);
            }

            if ($booking->BranchManagerApproval === 'Rejected' || $booking->HeadOfficeManagerApproval === 'Rejected') {
                $booking->BookingStatus = 'Rejected';
                $vehicle = $this->vehicleRepository->find($booking->VehicleID);
                $vehicle->VehicleStatus = 'Available';
                $vehicle->save();
            }

            $booking->save();

            return $booking;
        } catch (\Exception $e) {
            throw new \Exception('Failed to update booking approval: ' . $e->getMessage());
        }
    }

    public function returnBooking(Booking $booking, array $returnData)
    {
        try {
            $vehicle = $this->vehicleRepository->find($returnData['VehicleID']);
            $vehicle->VehicleStatus = 'Available';

            $initialKM = $vehicle->lastKM;
            $vehicle->LastKM = $returnData['LastKM'];

            $intervalKM = $vehicle->LastKM - $initialKM;
            $TotalFuelConsumptionPerKM = $vehicle->FuelConsumptionPerKM * $intervalKM;
            $vehicle->LastBBM = $vehicle->LastBBM - $TotalFuelConsumptionPerKM;
            $this->BookingHistoryService->store([
                'BookingID' => $booking->BookingID,
                'LastKM' => $returnData['LastKM'],
                'FuelConsumption' => $TotalFuelConsumptionPerKM,
            ]);
            $vehicle->KM_Need_Service = $vehicle->KM_Need_Service - $intervalKM;
            $vehicle->save();

            $vehicle->VehicleStatus = 'Available';
            $booking->save();

            return $booking;
        } catch (\Exception $e) {
            throw new \Exception('Failed to return vehicle: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        return $this->bookingRepository->delete($id);
    }

    public function find($id)
    {
        return $this->bookingRepository->find($id);
    }

    public function getBookingByVehicleID($id)
    {
        return $this->bookingRepository->getBookingByVehicle($id);
    }

    public function getBookingsForApproval($userID)
    {
        $bookings = $this->bookingRepository->getBookingsForApproval($userID);

        return $bookings;
    }
}
