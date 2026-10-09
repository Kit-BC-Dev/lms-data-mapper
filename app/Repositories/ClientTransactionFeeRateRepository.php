<?php

namespace App\Repositories;

use App\Models\Fees\ClientTransactionFeeRate;

class ClientTransactionFeeRateRepository
{
    public function __construct(protected ClientTransactionFeeRate $clientTransactionFeeRate){}

    public function create(array $data)
    {
        $this->clientTransactionFeeRate->upsert(
            $data,
            ['ExternalReference']
        );
    }
}