<?php

namespace App\Repositories;

use App\Models\Banks\UKBankAccount;

class UKBankAccountRepository extends BaseUKRepository
{
    public function __construct(protected UKBankAccount $model)
    {
        parent::__construct(
            $model,
            'BankAccountID'
        );
    }
    
}