<?php

namespace App\Interfaces;

interface BranchManagerRepositoryInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function find($id);
    public function all();
    public function approvalByBranchManager($id);
}
