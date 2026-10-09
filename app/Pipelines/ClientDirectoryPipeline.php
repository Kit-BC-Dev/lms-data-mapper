<?php

namespace App\Pipelines;

use App\Mapper\DirectoryMapper;
use App\Services\ClientDirectoryService;
use Closure;

class ClientDirectoryPipeline
{
    public function __construct(
        protected ClientDirectoryService $clientDirectoryService,
        protected DirectoryMapper $directoryMapper
    ){}

    public function handle($data, Closure $next)
    {
        
        $directories = [];
        $accountID = 0;
        $clienDirectorySpielID = 0;
        $directory = [];
        $externalReferences = [];
        foreach ($data['spiels'] as $spiel) {
            $accountID = $data['accountMappedData']['Account_' . $spiel->AccountFK]['AccountID'];
            $clienDirectorySpielID = $data['mappedData'][$accountID]['Spiel']['ClientDirectorySpielID'];


            if ($spiel->directory) {
                $directory = $spiel->directory->toArray();

                $externalReferences[] = $spiel->directory->DirectoryID;

            } else {
                $externalReference = 'New_Directory_For_' . $clienDirectorySpielID;
                $directory = [
                    'DirectoryID' => $externalReference,
                    'Name' => strtoupper($data['mappedData'][$accountID]['Outlet']['FirstName']),
                    'Active' => 0,
                    'ReasonInactive' => '',
                    'InternationalListing' => 0,
                    'NationalListing' => 0,
                    'RegionalListing' => 0,
                    'ShowAllOutlets' => 0
                ];
                $externalReferences[] = $externalReference;
            }

            $dto = $this->directoryMapper->map(
                $directory,
                $accountID,
                $clienDirectorySpielID
                
            );
            
            $directories[] = $dto->toArray();
           
        }
      
        $this->clientDirectoryService->create($directories);

        $directories = $this->clientDirectoryService->getByReference($externalReferences);

        foreach ($directories as $directory) {
            $data['mappedData'][$directory->AccountClientID]['Directory'] = $directory->toArray();
        }

        return $next($data);
    }
}