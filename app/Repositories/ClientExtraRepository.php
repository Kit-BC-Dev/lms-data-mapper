<?php

namespace App\Repositories;

use App\Models\Clients\ClientExtra;

class ClientExtraRepository
{
    public function __construct(protected ClientExtra $clientExtra){}

    public function createOrUpdate(array $data)
    {
         $this->clientExtra->upsert(
            $data,
            ['ClientID', 'Name'],
            [
                'ClientID',
                'Name',
                'Value'
            ]
        );
    }
}