<?php

namespace App\Interfaces;

interface CompanyDriverRepositoryInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function find($id);
    public function all();
}
