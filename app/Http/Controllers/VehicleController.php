<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }
    public function index()
    {
        $vehicles = $this->vehicleService->index();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $dataVehicle = $request->validated();
        $vehicle = $this->vehicleService->store($dataVehicle);
        return redirect('vehicles')->with('success', 'Vehicle created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        Log::info('VehicleController update' . json_encode($request->validated()));
        $dataVehicle = $request->validated();
        $vehicle = $this->vehicleService->update($dataVehicle, $vehicle->VehicleID);
        return redirect('vehicles')->with('success', 'Vehicle updated successfully');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService->delete($vehicle->VehicleID);
        return redirect('vehicles')->with('success', 'Vehicle deleted successfully');
    }
}
