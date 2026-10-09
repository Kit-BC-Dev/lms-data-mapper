<?php

namespace App\Services;

use App\Repositories\ClientTransactionScheduleRepository;

class ClientTransactionScheduleService
{
    public function __construct(protected ClientTransactionScheduleRepository $clientTransactionScheduleRepository){}

    public function create(array $data)
    {
        $this->clientTransactionScheduleRepository->updateOrCreate($data);
    }
}