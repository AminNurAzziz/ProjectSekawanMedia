<?php

namespace App\Services;

use App\Interfaces\BranchManagerRepositoryInterface;

class BranchManagerService
{
    protected $branchManagerRepository;

    public function __construct(BranchManagerRepositoryInterface $branchManagerRepository)
    {
        $this->branchManagerRepository = $branchManagerRepository;
    }

    public function getAllBranchManagers()
    {
        return $this->branchManagerRepository->all();
    }

    public function createBranchManager(array $data)
    {
        return $this->branchManagerRepository->create($data);
    }

    public function updateBranchManager(array $data, $id)
    {
        return $this->branchManagerRepository->update($data, $id);
    }

    public function deleteBranchManager($id)
    {
        return $this->branchManagerRepository->delete($id);
    }

    public function approvalByBranchManager($id)
    {
        return $this->branchManagerRepository->approvalByBranchManager($id);
    }
}
