<?php

namespace App\Pipelines;

use App\Mapper\ClientServiceMapper;
use App\Services\ClientServiceService;
use Closure;

class ClientServicePipeline
{
    public function __construct(
        protected ClientServiceService $clientServiceService,
        protected ClientServiceMapper $clientServiceMapper
    ){}

    public function handle($data, Closure $next)
    {
        $outletID = 0;
        $clientServices = [];

        foreach ($data['products'] as $product) {
            $accountID = $data['accountMappedData'][$product['account']]['AccountID'] ?? null;
            $outletID = $data['mappedData'][$accountID]['Outlet']['ClientID'] ?? null;
      
            foreach ($product['products'] as $clientService) {
                $clientServices[] = $this->clientServiceMapper
                    ->map($clientService->toArray(), $outletID)
                    ->toArray();
            }
        }


        $this->clientServiceService->create($clientServices);
        return $next($data);
    }
}