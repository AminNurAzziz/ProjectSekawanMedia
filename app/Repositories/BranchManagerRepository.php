<?php

namespace App\Repositories;

use App\Models\BranchManager;
use App\Interfaces\BranchManagerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class BranchManagerRepository implements BranchManagerRepositoryInterface
{
    public function create(array $data)
    {
        $account = User::create([
            'username' => $data['Name'],
            'email' => $data['Name'] . '@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'approver1'
        ]);
        $data = BranchManager::create($data);
        $data->UserID = $account->id;
        $data->save();
        return $data;
    }

    public function update(array $data, $id)
    {
        $manager = BranchManager::findOrFail($id);
        $manager->update($data);
        return $manager;
    }

    public function delete($id)
    {
        return BranchManager::destroy($id);
    }

    public function find($id)
    {
        return BranchManager::findOrFail($id);
    }

    public function all()
    {
        $allBranch = DB::table('branch_managers')
            ->join('branches', 'branch_managers.BranchID', '=', 'branches.BranchID')
            ->join('positions', 'branch_managers.PositionID', '=', 'positions.PositionID')
            ->select(
                'branch_managers.ManagerID',
                'branch_managers.Name',
                'branch_managers.PhoneNumber',
                'branches.BranchID',
                'positions.PositionID',
                'branches.BranchName as branch_name',
                'positions.PositionName as position_name'
            )
            ->get();

        return $allBranch;
    }

    public function approvalByBranchManager($userID)
    {
        // Lakukan query untuk mengambil daftar booking yang perlu di-approve oleh pengguna
        $bookings = Booking::where('BranchManagerID', $userID)
            ->join('branch_managers', 'bookings.BranchManagerID', '=', 'branch_managers.ManagerID')
            ->where('BranchManagerApproval', false)
            ->get();

        Log::info($bookings);

        return $bookings;
    }
}
