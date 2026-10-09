<?php

namespace App\Repositories;

use App\Models\History\UKAccountTypeChange;

class UKAccountTypeChangeRepository extends BaseUKRepository
{
    public function __construct(UKAccountTypeChange $uKAccountTypeChange)
    {
        parent::__construct(
            $uKAccountTypeChange,
            'AccountTypeChangeID'
        );
    }
}