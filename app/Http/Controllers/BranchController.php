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
        parent::__construct();
        $this->branchService = $branchService;
    }

    public function index()
    {
        try {
            $branches = $this->branchService->getAllBranches();
            $this->logService->createLog('Fetched branches successfully', 'fetch');
            return view('branches.index', compact('branches'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch branches: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch branches: ' . $e->getMessage());
        }
    }

    public function store(StoreBranchRequest $request)
    {
        try {
            $data = $request->validated();
            $this->branchService->createBranch($data);
            $this->logService->createLog('Branch created successfully', 'store');
            return redirect('/branches')->with('success', 'Branch created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create branch: ' . $e->getMessage());
            return back()->with('error', 'Failed to create branch: ' . $e->getMessage());
        }
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        try {
            $data = $request->validated();
            $this->branchService->updateBranch($data, $branch->BranchID);
            $this->logService->createLog('Branch updated successfully', 'update');
            return redirect('/branches')->with('success', 'Branch updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update branch: ' . $e->getMessage());
            return back()->with('error', 'Failed to update branch: ' . $e->getMessage());
        }
    }

    public function destroy(Branch $branch)
    {
        try {
            $this->branchService->deleteBranch($branch->BranchID);
            $this->logService->createLog('Branch deleted successfully', 'delete');
            return redirect('/branches')->with('success', 'Branch deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete branch: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete branch: ' . $e->getMessage());
        }
    }
}
