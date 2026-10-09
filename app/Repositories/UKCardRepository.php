<?php

namespace App\Repositories;

use App\Models\Cards\UKCard;

class UKCardRepository extends BaseUKRepository
{
    public function __construct(UKCard $model)
    {
        parent::__construct(
            $model,
            'CardID',
            ['status']
        );
    }
}