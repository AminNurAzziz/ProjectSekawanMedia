<?php

namespace App\Services;

use App\Interfaces\BranchRepositoryInterface;

class BranchService
{
    protected $branchRepository;

    public function __construct(BranchRepositoryInterface $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function getAllBranches()
    {
        return $this->branchRepository->all();
    }

    public function createBranch(array $data)
    {
        return $this->branchRepository->create($data);
    }

    public function updateBranch(array $data, $id)
    {
        return $this->branchRepository->update($data, $id);
    }

    public function deleteBranch($id)
    {
        return $this->branchRepository->delete($id);
    }

    public function findBranch($id)
    {
        return $this->branchRepository->find($id);
    }
}
