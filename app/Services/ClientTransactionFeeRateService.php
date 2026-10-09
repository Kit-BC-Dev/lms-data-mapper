<?php

namespace App\Services;

use App\Repositories\ClientTransactionFeeRateRepository;

class ClientTransactionFeeRateService
{
    public function __construct(protected ClientTransactionFeeRateRepository $clientTransactionFeeRepository){}

    public function create(array $data)
    {
        $this->clientTransactionFeeRepository->create($data);
    }
}