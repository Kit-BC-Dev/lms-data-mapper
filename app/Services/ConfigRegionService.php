<?php

namespace App\Services;

use App\Repositories\ConfigRegionRepository;

class ConfigRegionService
{
    public function __construct(protected ConfigRegionRepository $configRegionRepository){}

    public function create(array $data)
    {
        $this->configRegionRepository->create($data);
    }
}