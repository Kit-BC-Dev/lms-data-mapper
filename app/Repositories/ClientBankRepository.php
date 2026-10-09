<?php

namespace App\Repositories;

use App\Models\Banks\ClientBank;
class ClientBankRepository
{
    public function __construct(protected ClientBank $clientBank){}

    public function updateOrCreate(array $data)
    {
        $this->clientBank->upsert(
            $data,
            ['AccountNumber']
        );
    }

    public function getBanksByReference(array $references)
    {
        return $this->clientBank->whereIn('ExternalReference', $references)->get();
    }
}