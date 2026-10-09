<?php

namespace App\Services;

use App\Repositories\ClientBankRepository;

class ClientBankService
{
    public function __construct(protected ClientBankRepository $clientBankRepository){}

    public function create(array $data)
    {
        $this->clientBankRepository->updateOrCreate($data);
    }

    public function getBanksByReference(array $references)
    {
        return $this->clientBankRepository->getBanksByReference($references);
    }
}