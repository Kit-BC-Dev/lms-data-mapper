<?php

namespace App\Services;

use App\Repositories\ClientTransactionRepository;

class ClientTransactionService
{
    public function __construct(protected ClientTransactionRepository $clientTransactionRepository){}

    public function create(array $data)
    {
        $this->clientTransactionRepository->updateOrCreate($data);
    }

    public function getByReference(array $references)
    {
        return $this->clientTransactionRepository->getByReference($references);
    }
}