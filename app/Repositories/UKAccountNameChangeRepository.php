<?php

namespace App\Repositories;

use App\Models\History\UKAccountNameChange;

class UKAccountNameChangeRepository extends BaseUKRepository
{
    public function __construct(UKAccountNameChange $model)
    {
        parent::__construct(
            $model,
            'AccountNameChangeID'
        );
    }
}