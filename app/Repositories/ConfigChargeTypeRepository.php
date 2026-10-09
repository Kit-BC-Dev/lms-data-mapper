<?php

namespace App\Repositories;

use App\Models\Charges\ConfigChargeType;
class ConfigChargeTypeRepository
{
    public function __construct(protected ConfigChargeType $chargeType){}

    public function create(array $data)
    {
        $this->chargeType->create($data);
    }

    public function getByExterReferences(array $externalReferences)
    {
        return $this->chargeType->select('ChargeTypeID', 'ExternalReference')->whereIn('ExternalReference', $externalReferences)->get();
    }
}