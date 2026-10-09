<?php

namespace App\Pipelines;

use Closure;

use App\Mapper\ClientOutletAdditionalContactMapper;
use App\Services\ClientOutletAdditionalContactService;
class ClientOutletAdditionalContactPipeline
{
    public function __construct(
        protected ClientOutletAdditionalContactMapper $clientOutletAdditionalContactMapper,
        protected ClientOutletAdditionalContactService $clientOutletAdditionalContactService
    )
    {
        //
    }
    public function handle(array $data, Closure $next): array
    {
        $outletAddtionalContacts = [];
        foreach ($data['outletPeople'] as $person) {
            $clientID = $data['outletRef']['Outlet_' . $person['outlet']]['ClientID'] ?? null;
            $personData = $data['personMappedData']['Person_' . $person['person']->PersonFK] ?? null;

            $dto = $this->clientOutletAdditionalContactMapper->map([ 
                'ClientID' => $clientID,
                'Title' => $personData['person']->Title ?? null,
                'FirstName' => $personData['person']->FirstName ?? null,
                'LastName' => $personData['person']->LastName ?? '',
                'Email' => $personData['person']->EmailAddress ?? null,
                'BusinessName' => $personData['person']->BusinessName ?? null,
                'Role' => $person['person']->PersonsPosition ?? null,
                'BusinessPhone' => $personData['person']->EmployerPhoneNumber ?? null,
                'HomePhone' => $personData['person']->HomePhoneNumber ?? null,
                'Mobile' => $personData['person']->MobileNumber ?? null,
                'Fax' => $personData['person']->Fax ?? null,
            ]);

            $outletAddtionalContacts[] = $dto->toArray();
        }

        $this->clientOutletAdditionalContactService->create($outletAddtionalContacts);

        return $next($data);
    }
}