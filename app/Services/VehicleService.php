<?php

namespace App\Services;

use App\Interfaces\VehicleRepositoryInterface;

class VehicleService
{
    protected $vehicleRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function index()
    {
        return $this->vehicleRepository->all();
    }

    public function store(array $data)
    {
        return $this->vehicleRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->vehicleRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->vehicleRepository->delete($id);
    }
}
