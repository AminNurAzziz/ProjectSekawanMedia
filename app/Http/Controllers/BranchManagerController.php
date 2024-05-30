<?php

namespace App\Http\Controllers;

use App\Models\BranchManager;
use App\Http\Requests\StoreBranchManagerRequest;
use App\Http\Requests\UpdateBranchManagerRequest;
use App\Services\BranchManagerService;
use App\Services\BranchService;
use App\Services\PositionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BranchManagerController extends Controller
{
    protected $branchManagerService;
    protected $branchService;
    protected $positionService;

    public function __construct(BranchManagerService $branchManagerService, BranchService $branchService, PositionService $positionService)
    {
        parent::__construct();
        $this->branchManagerService = $branchManagerService;
        $this->branchService = $branchService;
        $this->positionService = $positionService;
    }

    public function index()
    {
        try {
            $branchManagers = $this->branchManagerService->getAllBranchManagers();
            $branches = $this->branchService->getAllBranches();
            $positions = $this->positionService->getAllPositions();

            $this->logService->createLog('Fetched branch managers successfully', 'fetch');
            return view('branch-managers.index', compact('branchManagers', 'branches', 'positions'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch branch managers: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch branch managers: ' . $e->getMessage());
        }
    }

    public function store(StoreBranchManagerRequest $request)
    {
        $data = $request->validated();
        try {
            $branchManager = $this->branchManagerService->createBranchManager($data);

            $this->logService->createLog('Branch Manager created successfully', 'store');
            return redirect('/branch-managers')->with('success', 'Branch Manager created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create branch manager: ' . $e->getMessage());
            return redirect('/branch-managers')->with('error', 'Failed to create branch manager: ' . $e->getMessage());
        }
    }

    public function update(UpdateBranchManagerRequest $request, BranchManager $branchManager)
    {
        $data = $request->validated();
        try {
            $branchManager = $this->branchManagerService->updateBranchManager($data, $branchManager->ManagerID);

            $this->logService->createLog('Branch Manager updated successfully', 'update');
            return redirect('/branch-managers')->with('success', 'Branch Manager updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update branch manager: ' . $e->getMessage());
            return redirect('/branch-managers')->with('error', 'Failed to update branch manager: ' . $e->getMessage());
        }
    }

    public function destroy(BranchManager $branchManager)
    {
        try {
            $this->branchManagerService->deleteBranchManager($branchManager->ManagerID);

            $this->logService->createLog('Branch Manager deleted successfully', 'delete');
            return redirect('/branch-managers')->with('success', 'Branch Manager deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete branch manager: ' . $e->getMessage());
            return redirect('/branch-managers')->with('error', 'Failed to delete branch manager: ' . $e->getMessage());
        }
    }

    public function approvalsToMake()
    {
        try {
            $adminOrManager = Session::get('adminOrManager');
            // dd($adminOrManager);
            $idUser = $adminOrManager->HeadManagerID ?? $adminOrManager->ManagerID;
            // dd($idUser);
            $bookings = $this->branchManagerService->approvalByBranchManager($idUser);
            return view('branch-managers.approvals', compact('bookings'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch approvals: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch approvals: ' . $e->getMessage());
        }
    }
}
