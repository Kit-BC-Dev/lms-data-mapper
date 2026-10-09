<?php

namespace App\Repositories;

use App\Models\Transactions\ClientTransaction;

class ClientTransactionRepository
{
    public function __construct(protected ClientTransaction $clientTransaction){}

    public function updateOrCreate(array $data)
    {

        foreach (array_chunk($data, 1000) as $chunk) {
            $this->clientTransaction->upsert(
                $chunk,
                ['ExternalReference']
            );
        }
        
    }

    public function getByReference(array $references)
    {
        return $this->clientTransaction->whereIn('ExternalReference', $references)->get();
    }
}