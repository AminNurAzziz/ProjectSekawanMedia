<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Services\BranchService;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{
    protected $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = $this->branchService->getAllBranches();
        return response()->json($branches);
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
    public function store(StoreBranchRequest $request)
    {
        $data = $request->validated();
        $branch = $this->branchService->createBranch($data);
        return response()->json(
            [
                'message' => 'Branch created successfully',
                // 'branch' => $branch
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $data = $request->validated();
        $branch = $this->branchService->updateBranch($data, $branch->BranchID);
        return response()->json(
            [
                'message' => 'Branch updated successfully',
                // 'branch' => $branch
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch = $this->branchService->deleteBranch($branch->BranchID);
        return response()->json(
            [
                'message' => 'Branch deleted successfully',
                // 'branch' => $branch
            ]
        );
    }
}
