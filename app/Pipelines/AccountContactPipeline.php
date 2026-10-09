<?php

namespace App\Pipelines;

use App\Mapper\ClientRelationshipMapper;
use App\Services\ClientRelationshipService;
use App\Services\ClientService;
use App\Services\RelationshipTypeService;
use Closure;
class AccountContactPipeline
{
    public function __construct(
        private ClientRelationshipService $clientRelationshipService,
        private RelationshipTypeService $relationshipTypeService,
        private ClientRelationshipMapper $clientRelationshipMapper,
        private ClientService $clientService
    )
    {
        //
    }

    public function handle($data, Closure $next)
    {
        foreach (['Account Contact', 'Invoice Person', 'Signatory'] as $relationship) {
            $relationType = $this->relationshipTypeService->getByName($relationship);

            match ($relationship) {
                'Account Contact' => $this->mapAccountRelationships($data, $relationType->RelationshipTypeID, 'MainPersonFK'),
                'Invoice Person' => $this->mapAccountRelationships($data, $relationType->RelationshipTypeID, 'InvoicePersonFK'),
                'Signatory' => $this->mapAccountRelationships($data, $relationType->RelationshipTypeID, 'AgreementSignaturePersonFK'),
            };
        }

        return $next($data);
    }
    
    private function mapAccountRelationships($data, int $relationTypeID, string $foreignKey)
    {
        $personIDs = $data->pluck($foreignKey)
            ->filter(fn ($id) => $id != 0)
            ->unique()
            ->values()
            ->map(fn ($id, $index) => "Person_" . $id)
            ->toArray();

        $persons = $this->clientService->getByExternalApiRefs($personIDs, 'mysql_staging')->mapWithKeys(fn ($person) => [
            $person->ExternalAPIRef => [
                'PersonID' => $person->ClientID,
            ],
        ])->all();
        
        foreach ($data['accounts'] as $account) {

            $dto = $this->clientRelationshipMapper->map([
                'RelationshipTypeID' => $relationTypeID,
                'ClientID' => $data['mapped_accounts']['Account_' . $account['AccountID']]['AccountID'] ?: 0,
                'RelatedClientID' => $persons['Person_' . $account[$foreignKey]]['PersonID'] ?: 0,
            ]);
            $relationships[] = $dto->toArray();
        }

        $this->clientRelationshipService->create($relationships);
    }
}