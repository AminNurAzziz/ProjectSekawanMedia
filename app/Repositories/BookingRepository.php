<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Interfaces\BookingRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class BookingRepository implements BookingRepositoryInterface
{


    public function index()
    {
        $bookings = DB::table('bookings')
            ->join('vehicles', 'bookings.VehicleID', '=', 'vehicles.VehicleID')
            ->join('branch_managers', 'bookings.BranchManagerID', '=', 'branch_managers.ManagerID')
            ->join('head_office_managers', 'bookings.HeadOfficeManagerID', '=', 'head_office_managers.HeadManagerID')
            ->join('company_drivers', 'bookings.DriverID', '=', 'company_drivers.DriverID')
            ->select('bookings.*', 'vehicles.VehicleType', 'vehicles.VehicleStatus as VehicleStatus', 'branch_managers.Name as BranchManager', 'head_office_managers.Name as HeadOfficeManager', 'company_drivers.Name as Driver')
            ->get();

        return $bookings;
    }

    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function updateApproval($booking, $role_user, $bookingStatus)
    {
        if ($role_user === 'approver1' && $booking->BranchManagerApproval === 'Pending' && $booking->HeadOfficeManagerApproval === 'Pending') {
            $booking->BranchManagerApproval = $bookingStatus;
        } else if ($role_user === 'approver2' && $booking->HeadOfficeManagerApproval === 'Pending' && $booking->BranchManagerApproval === 'Approved') {
            $booking->HeadOfficeManagerApproval = $bookingStatus;
        } else {
            throw new ModelNotFoundException('User not authorized to approve booking');
        }

        return $booking->save();
    }

    public function delete($id)
    {
        return Booking::destroy($id);
    }

    public function find($id)
    {
        return Booking::findOrFail($id);
    }

    public function all()
    {
        return Booking::all();
    }

    public function getByBranch($branchID)
    {
        return Booking::where('branch_id', $branchID)->get();
    }

    public function getByBranchManager($managerID)
    {
        return Booking::where('branch_manager_id', $managerID)->get();
    }

    public function getByHeadOfficeManager($managerID)
    {
        return Booking::where('head_office_manager_id', $managerID)->get();
    }

    public function getBookingByVehicle($vehicleID)
    {
        $booking = Booking::where('VehicleID', $vehicleID)->first();
        return $booking;
    }

    public function getBookingsForApproval($userID)
    {
        // Lakukan query untuk mengambil daftar booking yang perlu di-approve oleh pengguna
        $bookings = Booking::where('BranchManagerID', $userID)
            ->where('BranchManagerApproval', false)
            ->orWhere(function ($query) use ($userID) {
                $query->where('HeadOfficeManagerID', $userID)
                    ->where('HeadOfficeManagerApproval', false);
            })
            ->get();

        return $bookings;
    }
}
