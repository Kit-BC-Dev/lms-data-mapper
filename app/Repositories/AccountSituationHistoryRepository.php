<?php

namespace App\Repositories;

use App\Models\Accounts\AccountSituationHistory;
class AccountSituationHistoryRepository
{
    public function __construct(protected AccountSituationHistory $accountSituationHistory){}

    public function updateOrCreate(array $data): void
    {
        $this->accountSituationHistory->upsert(
            $data,
            ['ExternalReference']
        );
    }
}