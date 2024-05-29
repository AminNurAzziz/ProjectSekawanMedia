<?php

namespace App\Http\Controllers;

use App\Models\BranchManager;
use App\Http\Requests\StoreBranchManagerRequest;
use App\Http\Requests\UpdateBranchManagerRequest;
use App\Services\BranchManagerService;

class BranchManagerController extends Controller
{
    protected $branchManagerService;

    public function __construct(BranchManagerService $branchManagerService)
    {
        $this->branchManagerService = $branchManagerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branchManagers = $this->branchManagerService->getAllBranchManagers();
        return response()->json($branchManagers);
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
        return response()->json(
            [
                'message' => 'Branch Manager created successfully',
                // 'branchManager' => $branchManager
            ]
        );
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

        return response()->json(
            [
                'message' => 'Branch Manager updated successfully',
                // 'branchManager' => $branchManager
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchManager $branchManager)
    {
        $this->branchManagerService->deleteBranchManager($branchManager->ManagerID);
        return response()->json(['message' => 'Branch Manager deleted successfully']);
    }
}
