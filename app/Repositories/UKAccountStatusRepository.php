<?php

namespace App\Repositories;

use App\Models\Accounts\DBUKAccountStatus;

class UKAccountStatusRepository extends BaseUKRepository
{
    public function __construct(DBUKAccountStatus $model)
    {
        parent::__construct(
            $model,
            'AccountFK',
            ['status', 'type', 'account'],
            'Modified'
        );
    }
}