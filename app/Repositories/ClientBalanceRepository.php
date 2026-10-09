<?php

namespace App\Repositories;

use App\Models\Balances\ClientBalance;

class ClientBalanceRepository
{
    public function __construct(protected ClientBalance $clientBalance){}

    public function updateOrCreate(array $data)
    {
        $this->clientBalance->upsert(
            $data,
            ['ExternalReference']
        );
    }

    public function getAccountBalance(int $clientID)
    {
        return $this->clientBalance->where('ClientID', $clientID);
    }
}