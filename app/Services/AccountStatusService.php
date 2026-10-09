<?php

namespace App\Services;

use App\Repositories\AccountStatusRepository;

class AccountStatusService
{
    public function __construct(protected AccountStatusRepository $accountStatusRepository){}

    public function get()
    {
        return $this->accountStatusRepository->get();
    }
}