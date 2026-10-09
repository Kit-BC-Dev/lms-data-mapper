<?php

namespace App\Services;

use App\Repositories\UKRegionRepository;

class UKRegionService
{
    public function __construct(protected UKRegionRepository $uKRegionRepository){}

    public function get()
    {
        return $this->uKRegionRepository->get();
    }
}