<?php

namespace App\Services;

use App\Interfaces\CompanyDriverRepositoryInterface;

class CompanyDriverService
{
    protected $companyDriverRepository;

    public function __construct(CompanyDriverRepositoryInterface $companyDriverRepository)
    {
        $this->companyDriverRepository = $companyDriverRepository;
    }

    public function getAllCompanyDrivers()
    {
        return $this->companyDriverRepository->all();
    }

    public function createCompanyDriver(array $data)
    {
        return $this->companyDriverRepository->create($data);
    }

    public function updateCompanyDriver(array $data, $id)
    {
        return $this->companyDriverRepository->update($data, $id);
    }

    public function deleteCompanyDriver($id)
    {
        return $this->companyDriverRepository->delete($id);
    }
}
