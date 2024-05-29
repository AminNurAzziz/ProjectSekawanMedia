<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Interfaces\BookingRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingRepository implements BookingRepositoryInterface
{
    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function updateApproval($booking, $role_user)
    {
        if ($role_user === 'approver1' && !$booking->BranchManagerApproval) {
            $booking->BranchManagerApproval = true;
        } else if ($role_user === 'approver2' && !$booking->HeadOfficeManagerApproval && $booking->BranchManagerApproval) {
            $booking->HeadOfficeManagerApproval = true;
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
}
