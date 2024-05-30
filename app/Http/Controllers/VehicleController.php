<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        parent::__construct();
        $this->vehicleService = $vehicleService;
    }

    public function index()
    {
        try {
            $vehicles = $this->vehicleService->index();

            $this->logService->createLog('Fetched vehicles successfully', 'fetch');
            return view('vehicles.index', compact('vehicles'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch vehicles: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch vehicles: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(StoreVehicleRequest $request)
    {
        $dataVehicle = $request->validated();
        try {
            $this->vehicleService->store($dataVehicle);

            $this->logService->createLog('Vehicle created successfully', 'store');
            return redirect('vehicles')->with('success', 'Vehicle created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create vehicle: ' . $e->getMessage());
            return redirect('vehicles')->with('error', 'Failed to create vehicle: ' . $e->getMessage());
        }
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $dataVehicle = $request->validated();
        try {
            $this->vehicleService->update($dataVehicle, $vehicle->VehicleID);

            $this->logService->createLog('Vehicle updated successfully', 'update');
            return redirect('vehicles')->with('success', 'Vehicle updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update vehicle: ' . $e->getMessage());
            return redirect('vehicles')->with('error', 'Failed to update vehicle: ' . $e->getMessage());
        }
    }

    public function destroy(Vehicle $vehicle)
    {
        try {
            $this->vehicleService->delete($vehicle->VehicleID);

            $this->logService->createLog('Vehicle deleted successfully', 'delete');
            return redirect('vehicles')->with('success', 'Vehicle deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete vehicle: ' . $e->getMessage());
            return redirect('vehicles')->with('error', 'Failed to delete vehicle: ' . $e->getMessage());
        }
    }

    public function resetKMService($id)
    {
        try {
            $this->vehicleService->resetKMService($id);

            $this->logService->createLog('Vehicle service KM reset successfully', 'reset');
            return redirect('vehicles')->with('success', 'Vehicle service KM reset successfully');
        } catch (\Exception $e) {
            Log::error('Failed to reset vehicle service KM: ' . $e->getMessage());
            return redirect('vehicles')->with('error', 'Failed to reset vehicle service KM: ' . $e->getMessage());
        }
    }

    public function addBBM(Request $request, $id)
    {
        try {
            $BBM = $request->input('BBMField');

            // Memanggil method addBBM dari service
            $this->vehicleService->addBBM($id, $BBM);

            // Membuat log berhasil
            $this->logService->createLog('Vehicle BBM added successfully', 'add');

            // Redirect dengan pesan sukses
            return redirect('vehicles')->with('success', 'Vehicle BBM added successfully');
        } catch (\Exception $e) {
            // Jika terjadi exception, log error dan redirect dengan pesan error
            Log::error('Failed to add vehicle BBM: ' . $e->getMessage());
            return redirect('vehicles')->with('error', 'Failed to add vehicle BBM: ' . $e->getMessage());
        }
    }
}
