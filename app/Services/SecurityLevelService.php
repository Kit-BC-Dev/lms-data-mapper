<?php

namespace App\Services;

use App\Repositories\SeucrityLevelRepository;

class SecurityLevelService
{
    public function __construct(private SeucrityLevelRepository $seucrityLevelRepository){}

    public function create(array $data)
    {
        return $this->seucrityLevelRepository->create($data);
    }

    public function getBySecurityLevel(array $serurityLevels)
    {
        return $this->seucrityLevelRepository->getBySecurityLevel($serurityLevels);
    }
}