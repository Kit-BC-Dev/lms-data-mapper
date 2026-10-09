<?php

namespace App\Repositories;

use App\Models\Charges\UKChargeType;
class UKChargeTypeRepository
{
    public function __construct(protected UKChargeType $uKChargeType){}

    public function get()
    {
        return $this->uKChargeType->with(['types'])->get();
    }
}