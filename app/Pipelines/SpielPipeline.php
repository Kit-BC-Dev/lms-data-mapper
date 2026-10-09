<?php

namespace App\Pipelines;

use App\Mapper\SpielMapper;
use App\Services\SpielService;
use App\Services\ClientService;
use Closure;

class SpielPipeline
{
    public function __construct(
        protected SpielService $spielService,
        protected SpielMapper $spielMapper,
        protected ClientService $clientService
    ){}

    public function handle($data, Closure $next)
    {
        $spiels = [];
        $spielExternalReferences = [];
        foreach ($data['spiels'] as $spiel) {

            $dto = $this->spielMapper->map(
                [
                    'SpielID' => $spiel->SpielID,
                    'SpielContent' => $spiel->SpielContent
                ],
                $data['accountMappedData']['Account_' . $spiel->AccountFK]['AccountID']
            );
                    
            $spielExternalReferences[] = $spiel->SpielID;
            $spiels[] = $dto->toArray();
            
        }

        $this->spielService->create($spiels);
        $spiels = $this->spielService->getSpielsFromReference($spielExternalReferences);
        
        foreach ($spiels as $spiel) {
            $data['mappedData'][$spiel->AccountClientID]['Spiel'] = $spiel->toArray();
        }
    
        return $next($data);
        
    }
}