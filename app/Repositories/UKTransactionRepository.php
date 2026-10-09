<?php

namespace App\Repositories;

use App\Models\Transactions\UKTransaction;

class UKTransactionRepository extends BaseUKRepository
{
    public function __construct(UKTransaction $model)
    {
        parent::__construct(
            $model,
            'TransactionID',
            ['note']
        );
    }
    
}