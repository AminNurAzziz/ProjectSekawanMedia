<?php

namespace App\Services;

use App\Interfaces\HeadOfficeManagerRepositoryInterface;

class HeadOfficeManagerService
{
    protected $headOfficeManagerRepository;

    public function __construct(HeadOfficeManagerRepositoryInterface $headOfficeManagerRepository)
    {
        $this->headOfficeManagerRepository = $headOfficeManagerRepository;
    }

    public function getAllHeadOfficeManagers()
    {
        return $this->headOfficeManagerRepository->all();
    }

    public function createHeadOfficeManager(array $data)
    {
        return $this->headOfficeManagerRepository->create($data);
    }

    public function updateHeadOfficeManager(array $data, $id)
    {
        return $this->headOfficeManagerRepository->update($data, $id);
    }

    public function deleteHeadOfficeManager($id)
    {
        return $this->headOfficeManagerRepository->delete($id);
    }
}
