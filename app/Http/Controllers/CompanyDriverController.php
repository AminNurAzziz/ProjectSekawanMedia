<?php

namespace App\Http\Controllers;

use App\Models\CompanyDriver;
use App\Http\Requests\StoreCompanyDriverRequest;
use App\Http\Requests\UpdateCompanyDriverRequest;
use App\Services\CompanyDriverService;
use Illuminate\Support\Facades\Log;

class CompanyDriverController extends Controller
{
    protected $companyDriverService;

    public function __construct(CompanyDriverService $companyDriverService)
    {
        parent::__construct();
        $this->companyDriverService = $companyDriverService;
    }

    public function index()
    {
        try {
            $companyDrivers = $this->companyDriverService->getAllCompanyDrivers();

            $this->logService->createLog('Fetched company drivers successfully', 'fetch');
            return view('company-drivers.index', compact('companyDrivers'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch company drivers: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch company drivers: ' . $e->getMessage());
        }
    }

    public function store(StoreCompanyDriverRequest $request)
    {
        $data = $request->validated();
        try {
            $this->companyDriverService->createCompanyDriver($data);

            $this->logService->createLog('Company Driver created successfully', 'store');
            return redirect('/company-drivers')->with('success', 'Company Driver created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create company driver: ' . $e->getMessage());
            return back()->with('error', 'Failed to create company driver: ' . $e->getMessage());
        }
    }

    public function update(UpdateCompanyDriverRequest $request, CompanyDriver $companyDriver)
    {
        $data = $request->validated();
        try {
            $this->companyDriverService->updateCompanyDriver($data, $companyDriver->DriverID);

            $this->logService->createLog('Company Driver updated successfully', 'update');
            return redirect('/company-drivers')->with('success', 'Company Driver updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update company driver: ' . $e->getMessage());
            return back()->with('error', 'Failed to update company driver: ' . $e->getMessage());
        }
    }

    public function destroy(CompanyDriver $companyDriver)
    {
        try {
            $this->companyDriverService->deleteCompanyDriver($companyDriver->DriverID);

            $this->logService->createLog('Company Driver deleted successfully', 'delete');
            return response()->json(['message' => 'Company Driver deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to delete company driver: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete company driver: ' . $e->getMessage()], 500);
        }
    }
}
