<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Interfaces\VehicleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function create(array $data)
    {
        Log::info('VehicleRepository create' . json_encode($data));
        return Vehicle::create($data);
    }

    public function update(array $data, $id)
    {
        Log::info('VehicleRepository update' . $id);
        // Temukan entitas berdasarkan ID
        $vehicle = Vehicle::find($id);

        // Periksa apakah entitas ditemukan
        if (!$vehicle) {
            throw new \Exception('Vehicle not found'); // Atau gunakan penanganan yang sesuai
        }

        // Jika ditemukan, lakukan pembaruan
        $vehicle->update($data);

        return $vehicle;
    }


    public function delete($id)
    {
        return Vehicle::destroy($id);
    }

    public function find($id)
    {
        return Vehicle::findOrFail($id);
    }

    public function all()
    {
        return Vehicle::all();
    }
}
