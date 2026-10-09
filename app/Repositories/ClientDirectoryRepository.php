<?php

namespace App\Repositories;

use App\Models\ClientDirectory\ClientDirectory;

class ClientDirectoryRepository
{
    public function __construct(protected ClientDirectory $clientDirectory){}

    public function updateOrCreate(array $data)
    {
        $this->clientDirectory->upsert(
            $data,
            [
                'AccountClientID',
                'ClientDirectorySpielID'
            ]
        );
    }

    public function getByReference(array $references)
    {
        return $this->clientDirectory->whereIn('ExternalReference', $references)->get();
    }
}