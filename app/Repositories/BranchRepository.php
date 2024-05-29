<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Interfaces\BranchRepositoryInterface;

class BranchRepository implements BranchRepositoryInterface
{
    public function create(array $data)
    {
        return Branch::create($data);
    }

    public function update(array $data, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($data);
        return $branch;
    }

    public function delete($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return $branch;
    }

    public function find($id)
    {
        return Branch::findOrFail($id);
    }

    public function all()
    {
        return Branch::all();
    }
}
