<?php

namespace App\Repositories;

use App\Models\Balances\UKAccountBalance;

class UKAccountBalancesRepository extends BaseUKRepository
{
    public function __construct(UKAccountBalance $model)
    {
        parent::__construct(
            $model, 
            'AccountFK',
            [],
            'Modified'
        );
    }

}