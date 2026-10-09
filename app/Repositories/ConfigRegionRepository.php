<?php

namespace App\Repositories;

use App\Models\Regions\ConfigRegion;

class ConfigRegionRepository
{
    public function __construct(protected ConfigRegion $configRegion){}

    public function create(array $data)
    {
        $this->configRegion->create($data);
    }
}