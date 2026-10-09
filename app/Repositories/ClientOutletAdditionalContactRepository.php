<?php

namespace App\Repositories;

use App\Models\Clients\ClientOutletAdditionalContact;

class ClientOutletAdditionalContactRepository
{
    public function __construct(protected ClientOutletAdditionalContact $clientOutletAdditionalContact)
    {
    }

    public function updateAndCreate(array $data): void
    {
        $this->clientOutletAdditionalContact->upsert(
            $data,
            ['ClientID', 'Email']
        );
    }
}