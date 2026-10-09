<?php

namespace App\Repositories;

use App\Models\History\UKAccountStatusChange;

class UKAccountStatusChangeRepository extends BaseUKRepository
{
    public function __construct(UKAccountStatusChange $model)
    {
        parent::__construct(
            $model,
            'AccountStatusChangeID'
        );
    }
}