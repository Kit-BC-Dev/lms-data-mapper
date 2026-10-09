<?php

namespace App\Repositories;

use App\Models\ClientService\ClientService;

class ClientServiceRepository
{
    public function __construct(protected ClientService $clientService){}

    public function updateOrCreate(array $data)
    {
        $this->clientService->upsert(
            $data,
            [
                'ClientID',
                'ClientDirectoryCategoryID'
            ]
        );
    }
}