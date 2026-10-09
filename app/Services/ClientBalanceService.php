<?php

namespace App\Services;

use App\Repositories\ClientBalanceRepository;

class ClientBalanceService
{
    public function __construct(protected ClientBalanceRepository $clientBalanceRepository){}

    public function create(array $data)
    {
        $this->clientBalanceRepository->updateOrCreate($data);
    }

    public function getAccountBalance(int $clientID)
    {
        return $this->clientBalanceRepository->getAccountBalance($clientID);
    }
}