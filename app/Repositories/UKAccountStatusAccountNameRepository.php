<?php

namespace App\Repositories;

use App\Models\Accounts\DBUKAccountStatus;

class UKAccountStatusAccountNameRepository extends BaseUKRepository
{
    public function __construct(DBUKAccountStatus $dBUKAccountStatus)
    {
        parent::__construct(
            $dBUKAccountStatus,
            'AccountFK',
            ['Account'],
            'Modified'
        );
    }
}