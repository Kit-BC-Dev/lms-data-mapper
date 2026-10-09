<?php

namespace App\Services;

use App\Repositories\UKChargeTypeRepository;

class UKChargeTypeService
{
    public function __construct(protected UKChargeTypeRepository $uKChargeTypeRepository ){}

    public function get()
    {
        return $this->uKChargeTypeRepository->get();
    }
}