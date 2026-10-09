<?php

namespace  App\Repositories;

use App\Models\Clients\Client;
use App\DTO\ClientDTO;
class ClientRepository
{

    public function __construct(private Client $client){}
    public function updateOrCreate(array $data)
    {
        
       $this->client->upsert(
            $data,
            ['ExternalAPIRef'],
        );
    }

    public function getOutletAccounts(array $parentIDs)
    {
        return $this->client->on('mysql_staging')->select('ClientID', 'ExternalAPIRef')->whereIn('ExternalAPIRef', $parentIDs)->get();
    }

    public function getByExternalApiRefs(array $externalApiRefs, string $connection = 'mysql_staging')
    {
        return $this->client
            ->on($connection)
            ->with(['status', 'type', 'recentBalance', 'loans'])
            ->whereIn('ExternalAPIRef', $externalApiRefs)
            ->get();
    }

    public function getClientAccountsWithLoans()
    {
        return $this->client->with('loans')->where('ClientTypeID', 1)
            ->whereDate('DateCreated', '>=', '2026-07-01 00:00:00')
            ->whereNotNull('ExternalAPIRef')
            ->get();
    }

    public function getOutletClient(
        int $size,
        callable $callback
    )
    {
        return $this->client->select(['ClientID', 'ParentClientID', 'PrimaryAddressID'])
            ->where('ClientTypeID', 2)
            ->with('address', 'spiel')
            ->orderBy('ClientID')
            ->chunkById(
                $size,
                $callback
        );
    }

    public function getTotalOutletClient()
    {
        return $this->client->where('ClientTypeID', 2)->count();
    }

    public function getClientByFirstName(array $names)
    {
        return $this->client->select('ClientID', 'ParentClientID', 'FirstName')
            ->whereIn('FirstName', $names)
            ->where('ClientTypeID', 1)
            ->get();
    }
}