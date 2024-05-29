<?php

namespace App\Services;

use App\Interfaces\PositionRepositoryInterface;

class PositionService
{
    protected $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function getAllPositions()
    {
        return $this->positionRepository->all();
    }

    public function createPosition($data)
    {
        return $this->positionRepository->create($data);
    }

    public function updatePosition($data, $id)
    {
        return $this->positionRepository->update($data, $id);
    }

    public function deletePosition($id)
    {
        return $this->positionRepository->delete($id);
    }
}
