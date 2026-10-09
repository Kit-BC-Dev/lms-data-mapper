<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{
    public function __construct(protected ClientRepository $clientRepository){}

    public function create(array $clients)
    {
        $this->clientRepository->updateOrCreate($clients);
    }

    public function getOutletAccounts(array $parentIDs)
    {
        return $this->clientRepository->getOutletAccounts($parentIDs);
    }

    public function getByExternalApiRefs(array $externalApiRefs, $connection = 'mysql_staging')
    {
        return $this->clientRepository->getByExternalApiRefs($externalApiRefs, $connection);
    }

    public function getClientAccountsWithLoans()
    {
        return $this->clientRepository->getClientAccountsWithLoans();
    }

    public function getClientByFirstName(array $names)
    {
        return $this->clientRepository->getClientByFirstName($names);
    }

   
}