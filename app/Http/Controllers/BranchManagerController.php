<?php

namespace App\Http\Controllers;

use App\Models\BranchManager;
use App\Http\Requests\StoreBranchManagerRequest;
use App\Http\Requests\UpdateBranchManagerRequest;
use App\Services\BranchManagerService;
use App\Services\BranchService;
use App\Services\PositionService;
use Illuminate\Support\Facades\Log;

class BranchManagerController extends Controller
{
    protected $branchManagerService;
    protected $branchService;
    protected $positionService;

    public function __construct(BranchManagerService $branchManagerService, BranchService $branchService, PositionService $positionService)
    {
        $this->branchManagerService = $branchManagerService;
        $this->branchService = $branchService;
        $this->positionService = $positionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branchManagers = $this->branchManagerService->getAllBranchManagers();
        $branches = $this->branchService->getAllBranches();
        $positions = $this->positionService->getAllPositions();
        return view('branch-managers.index', compact('branchManagers', 'branches', 'positions'));
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
    public function store(StoreBranchManagerRequest $request)
    {
        $data = $request->validated();
        $branchManager = $this->branchManagerService->createBranchManager($data);
        return redirect('/branch-managers')->with('success', 'Branch Manager created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(BranchManager $branchManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BranchManager $branchManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchManagerRequest $request, BranchManager $branchManager)
    {
        $data = $request->validated();
        $branchManager = $this->branchManagerService->updateBranchManager($data, $branchManager->ManagerID);

        return redirect('/branch-managers')->with('success', 'Branch Manager updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchManager $branchManager)
    {
        $this->branchManagerService->deleteBranchManager($branchManager->ManagerID);
        return redirect('/branch-managers')->with('success', 'Branch Manager deleted successfully');
    }

    public function approvalsToMake()
    {
        // Ambil daftar booking yang perlu di-approve oleh pengguna
        $bookings = $this->branchManagerService->approvalByBranchManager(auth()->user()->id);

        // Kembalikan response JSON
        // return response()->json(['bookings' => $bookings], 200);

        return view('branch-managers.approvals', compact('bookings'));
    }
}
