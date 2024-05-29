<?php

namespace App\Http\Controllers;

use App\Models\CompanyDriver;
use App\Http\Requests\StoreCompanyDriverRequest;
use App\Http\Requests\UpdateCompanyDriverRequest;
use App\Services\CompanyDriverService;

class CompanyDriverController extends Controller
{
    protected $companyDriverService;

    public function __construct(CompanyDriverService $companyDriverService)
    {
        $this->companyDriverService = $companyDriverService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyDrivers = $this->companyDriverService->getAllCompanyDrivers();

        return view('company-drivers.index', compact('companyDrivers'));
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
    public function store(StoreCompanyDriverRequest $request)
    {
        $data = $request->validated();
        $this->companyDriverService->createCompanyDriver($data);
        return redirect('/company-drivers')->with('success', 'Company Driver created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyDriver $companyDriver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyDriver $companyDriver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyDriverRequest $request, CompanyDriver $companyDriver)
    {
        $data = $request->validated();
        $companyDriver = $this->companyDriverService->updateCompanyDriver($data, $companyDriver->DriverID);

        return redirect('/company-drivers')->with('success', 'Company Driver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyDriver $companyDriver)
    {
        $this->companyDriverService->deleteCompanyDriver($companyDriver->DriverID);
        return response()->json(
            [
                'message' => 'Company Driver deleted successfully'
            ]
        );
    }
}
