<?php

namespace App\Pipelines;

use App\Mapper\ClientRelationshipMapper;
use App\Services\ClientRelationshipService;
use App\Services\RelationshipTypeService;
use Closure;

class ClientRelationshipPipeline
{
    public function __construct(
        protected ClientRelationshipService $clientRelationshipService,
        protected RelationshipTypeService $relationshipTypeService,
        protected ClientRelationshipMapper $clientRelationshipMapper
    ){}

    public function handle($data, Closure $next)
    {
        $relationshipType = $this->relationshipTypeService->getByName('Account Outlet');
        $OutletRelationshipType = $this->relationshipTypeService->getByName('Outlet Contact');

        $clientRelationships = [];
        foreach ($data['clients'] as $client) {
            $outletMainPersonID = $data['mappedData'][$client->ParentClientID]['Outlet']['MainPersonFK'] ?? null;
            $dto = $this->clientRelationshipMapper->map(
                [
                    'RelationshipTypeID' => $relationshipType->RelationshipTypeID,
                    'ClientID' => $client->ParentClientID,
                    'RelatedClientID' => $client->ClientID
                ]
            );

            $clientRelationships[] = $dto->toArray();

            $dto = $this->clientRelationshipMapper->map(
                [
                    'RelationshipTypeID' => $OutletRelationshipType->RelationshipTypeID,
                    'ClientID' => $client->ClientID,
                    'RelatedClientID' => $data['personMappedData']['Person_' . $outletMainPersonID]->ClientID ?? null
                ]
            );

            $clientRelationships[] = $dto->toArray();
        }
       
        $this->clientRelationshipService->create($clientRelationships);

        $next($data);
    }
}