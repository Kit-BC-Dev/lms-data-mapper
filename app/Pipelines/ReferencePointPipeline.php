<?php

namespace App\Pipelines;

use App\Mapper\ReferencePointMapper;
use App\Services\ReferencePointService;
use Closure;
class ReferencePointPipeline
{
    public function __construct(
        protected ReferencePointService $referencePointService,
        protected ReferencePointMapper $referencePointMapper
    ){}

    public function handle($data, Closure $next)
    {
        $referencePoints = [];

        foreach ($data['spiels'] as $spiel) {
            $accountID = $data['accountMappedData']['Account_' . $spiel->AccountFK]['AccountID'];
            $outletID = $data['mappedData'][$accountID]['Outlet']['ClientID'];
            $directoryID = $data['mappedData'][$accountID]['Directory']['ClientDirectoryID'];

            $dto = $this->referencePointMapper->map(
                [
                    'ClientDirectoryID' => $directoryID,
                    'AccountClientID' => $accountID,
                    'OutletID' => $outletID,
                ]
            );

            $referencePoints[] = $dto->toArray();
        }
        $this->referencePointService->create($referencePoints);
        return $next($data);
    }
}