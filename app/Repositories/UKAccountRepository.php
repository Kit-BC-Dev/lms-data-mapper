<?php

namespace App\Repositories;

use App\Models\Accounts\Account;

class UKAccountRepository extends BaseUKRepository
{
    public function __construct(Account $model)
    {
        parent::__construct(
            $model,
            'AccountID',
            ['details', 'trading', 'web']
        );
    }

}