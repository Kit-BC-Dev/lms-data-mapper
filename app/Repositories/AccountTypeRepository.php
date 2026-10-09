<?php

namespace App\Repositories;

use App\Models\Accounts\AccountType;
class AccountTypeRepository
{
    public function __construct(protected AccountType $accountType)
    {
    }

    public function get()
    {
        return $this->accountType->get();
    }
}