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
        return response()->json(
            [
                'status' => 'success',
                'data' => $vehicles
            ],
            200
        );
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $dataVehicle = $request->validated();
        $vehicle = $this->vehicleService->store($dataVehicle);
        return response()->json(
            [
                'status' => 'success',
                'data' => $vehicle
            ],
            201
        );
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
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Successfully updated vehicle',
            ],
            200
        );
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService->delete($vehicle->VehicleID);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Successfully deleted vehicle',
            ],
            200
        );
    }
}
