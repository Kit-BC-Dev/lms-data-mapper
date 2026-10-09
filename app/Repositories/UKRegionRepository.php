<?php

namespace App\Repositories;

use App\Models\Regions\UKRegions;

class UKRegionRepository
{
    public function __construct(protected UKRegions $uKRegions){}

    public function get()
    {
        return $this->uKRegions->get();
    }
}