<?php

namespace App\Repositories;

use App\Models\Transactions\ClientTransactionSchedule;

class ClientTransactionScheduleRepository
{
    public function __construct(protected ClientTransactionSchedule $clientTransactionSchedule){}

    public function updateOrCreate(array $data)
    {
        $this->clientTransactionSchedule->upsert(
            $data,
            ['ExternalReference']
        );
    }
}