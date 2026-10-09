<?php

namespace App\Repositories;

use App\Models\Charges\UKCharges;

class UKChargesRepository extends BaseUKRepository
{
    public function __construct(UKCharges $model)
    {
        parent::__construct(
            $model,
            'ChargeID'
        );
    }
}