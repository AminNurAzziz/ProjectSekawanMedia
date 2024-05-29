<?php

namespace App\Interfaces;

interface BookingRepositoryInterface
{
    public function index();
    public function create(array $data);
    public function updateApproval($id, $level_user, $bookingStatus);
    public function delete($id);
    public function find($id);
    public function all();
    public function getByBranch($branchID);
    public function getByBranchManager($managerID);
    public function getByHeadOfficeManager($managerID);
    public function getBookingByVehicle($vehicleID);
    public function getBookingsForApproval($userID);
}
