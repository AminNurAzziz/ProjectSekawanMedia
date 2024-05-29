<?php

namespace App\Repositories;

use App\Models\Position;
use App\Interfaces\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface
{
    public function create(array $data)
    {
        return Position::create($data);
    }

    public function update(array $data, $id)
    {
        $position = Position::findOrFail($id->PositionID);
        $position->update($data);
        return $position;
    }


    public function delete($id)
    {
        return Position::destroy($id);
    }

    public function find($id)
    {
        return Position::findOrFail($id);
    }

    public function all()
    {
        return Position::all();
    }
}
