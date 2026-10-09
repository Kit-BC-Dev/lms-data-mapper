<?php

namespace App\Services;

use App\Repositories\ConfigChargeTypeRepository;

class ConfigChargeTypeService
{
    public function __construct(protected ConfigChargeTypeRepository $configChargeTypeRepository){}

    public function create(array $data)
    {
        $this->configChargeTypeRepository->create($data);
    }

    public function getByExterReferences(array $references)
    {
        return $this->configChargeTypeRepository->getByExterReferences($references);
    }
}