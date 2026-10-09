<?php

namespace App\Repositories;

use App\Models\Clients\ClientAddressBook;

class ClientAddressBookRepository
{
    public function __construct(private ClientAddressBook $clientAddressBook){}

    public function updateOrCreate(array $data)
    {
        $this->clientAddressBook->upsert(
            $data,
            ['ExternalReference']
        );
    }
}