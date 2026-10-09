<?php

namespace App\Repositories;

use App\Models\Accounts\AccountStatus;

class AccountStatusRepository
{
    public function __construct(protected AccountStatus $accountStatus){}

    public function get()
    {
        return $this->accountStatus->get();
    }
}