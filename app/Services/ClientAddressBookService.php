<?php

namespace App\Services;

use App\Repositories\ClientAddressBookRepository;

class ClientAddressBookService
{
    public function __construct(private ClientAddressBookRepository $clientAddressBookRepository){}

    public function create(array $data)
    {
        $this->clientAddressBookRepository->updateOrCreate($data);
    }
}