<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Interfaces\VehicleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function create(array $data)
    {
        $KM_Need_Service = $data['ServiceIntervalKM'];
        $vehicle = Vehicle::create(
            [
                'VehicleID' => $data['VehicleID'],
                'VehicleModel' => $data['VehicleModel'],
                'VehicleType' => $data['VehicleType'],
                'VehicleStatus' => $data['VehicleStatus'],
                'FuelConsumptionPerKM' => $data['FuelConsumptionPerKM'],
                'ServiceIntervalKM' => $data['ServiceIntervalKM'],
                'KM_Need_Service' => $KM_Need_Service,
                'Ownership' => $data['Ownership'],
            ]
        );

        return $vehicle;
    }

    public function update(array $data, $id)
    {
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

    public function resetKMService($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->update(['KM_Need_Service' => $vehicle->ServiceIntervalKM]);
        return $vehicle;
    }

    public function addBBM($id, $data)
    {
        try {
            // Mencari kendaraan berdasarkan ID
            $vehicle = Vehicle::find($id);

            // Mengatur nilai LastBBM dengan nilai baru
            $vehicle->LastBBM = $data;

            // Menyimpan perubahan ke dalam database
            $vehicle->save();

            // Mengembalikan kendaraan setelah disimpan
            return $vehicle;
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan saat menyimpan
            Log::error('Failed to add BBM to vehicle: ' . $e->getMessage());
            throw new \Exception('Failed to add BBM to vehicle: ' . $e->getMessage());
        }
    }
}
