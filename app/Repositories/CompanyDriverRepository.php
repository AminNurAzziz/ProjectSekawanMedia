<?php

namespace App\Repositories;

use App\Models\CompanyDriver;
use App\Interfaces\CompanyDriverRepositoryInterface;

class CompanyDriverRepository implements CompanyDriverRepositoryInterface
{
    public function create(array $data)
    {
        return CompanyDriver::create($data);
    }

    public function update(array $data, $id)
    {
        $driver = CompanyDriver::findOrFail($id);
        $driver->update($data);
        return $driver;
    }

    public function delete($id)
    {
        return CompanyDriver::destroy($id);
    }

    public function find($id)
    {
        return CompanyDriver::findOrFail($id);
    }

    public function all()
    {
        return CompanyDriver::all();
    }
}
