<?php

namespace App\Services;

use App\Repositories\AccountTypeRepository;
class AccountTypeService
{
    public function __construct(protected AccountTypeRepository $accountTypeRepository)
    {
    }

    public function get()
    {
        return $this->accountTypeRepository->get();
    }
}