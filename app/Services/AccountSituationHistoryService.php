<?php

namespace App\Services;

use App\Repositories\AccountSituationHistoryRepository;

class AccountSituationHistoryService
{
    public function __construct(protected AccountSituationHistoryRepository $accountSituationHistoryRepository){}

    public function create(array $data)
    {
        $this->accountSituationHistoryRepository->updateOrCreate($data);
    }
}