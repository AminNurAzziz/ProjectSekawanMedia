<?php

namespace App\Interfaces;

interface VehicleRepositoryInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function find($id);
    public function all();
    public function resetKMService($id);
    public function addBBM($id, $data);
}
