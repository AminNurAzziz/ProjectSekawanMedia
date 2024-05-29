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

    // Implementasi metode lainnya sesuai kebutuhan aplikasi Anda
}
