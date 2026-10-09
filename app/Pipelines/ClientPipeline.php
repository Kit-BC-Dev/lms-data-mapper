<?php

namespace App\Pipelines;

use App\Mapper\ClientMapper;
use App\Services\AddressService;
use App\Services\ClientService;
use Closure;

class ClientPipeline
{
    public function __construct(
        protected ClientService $clientService,
        protected ClientMapper $clientMapper,
        protected AddressService $addressService
    ){}
    public function handle($data, Closure $next)
    {
        $addresses = $this->addressService
            ->getByIDs($data['addresses'])
            ?->keyBy('ExternalReference');

        $parents = $this->clientService
            ->getOutletAccounts($data['accounts'])
            ?->keyBy('ExternalAPIRef');

        $persons = $this->clientService
            ->getByExternalApiRefs($data['personRefID'])
            ?->keyBy('ExternalAPIRef');


        $mappedData = $parents->mapWithKeys(fn ($parent) => [
            $parent->ClientID => ['Outlet' => []],
        ])->all();

        $accountMappedData = $parents->mapWithKeys(fn ($parent) => [
            $parent->ExternalAPIRef => [
                'AccountID' => $parent->ClientID,
            ],
        ])->all();

        $personMappedData = $persons->mapWithKeys(fn ($person) => [
            $person->ExternalAPIRef => [
                'person' => $person,
            ],
        ])->all();
        $clients = [];
        $insertedClients = [];

        foreach ($data['outlets'] as $outlet) {
            $outlet->PrimaryAddressID =
                $addresses[$outlet->LocationAddressFK]->AddressID ?? null;

            $outlet->ParentClientID =
                $parents['Account_' . $outlet->AccountFK]->ClientID ?? null;

            $clients[] = $this->clientMapper
                ->map($outlet->toArray())
                ->toArray();
            $outletPerson['Outlet_' . $outlet->OutletID] = $outlet->MainPersonFK;
          
            $insertedClients[] = 'Outlet_' . $outlet->OutletID;
        }
        $this->clientService->create($clients);
        $clients = $this->clientService
            ->getByExternalApiRefs($insertedClients, 'mysql_staging');

        foreach ($clients as $client) {
            $mappedData[$client->ParentClientID]['Outlet'] = [
                'FirstName' => $client->FirstName,
                'ClientID'  => $client->ClientID,
                'ExternalAPIRef' => $client->ExternalAPIRef,
                'MainPersonFK' => $outletPerson[$client->ExternalAPIRef] ?? null,
            ];

            $outletRef[$client->ExternalAPIRef] = ['ClientID' => $client->ClientID];
        }

        unset(
            $data['accounts'],
            $data['addresses'],
            $data['outlets']
        );

        $data['mappedData'] = $mappedData;
        $data['accountMappedData'] = $accountMappedData;
        $data['clients'] = $clients;
        $data['personMappedData'] = $personMappedData;
        $data['outletRef'] = $outletRef;

        return $next($data);
    }
}