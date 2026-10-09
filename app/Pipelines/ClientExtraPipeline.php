<?php

namespace App\Pipelines;

use App\Services\ClientExtraService;
use App\Mapper\ClientExtraMapper;
use Closure;

class ClientExtraPipeline
{
    public function __construct(
        protected ClientExtraService $clientExtraService,
        protected ClientExtraMapper $clientExtraMapper
    ){}

    public function handle($data, Closure $next)
    {
        $extras = [];

        foreach ($data['extras'] as $extra) {

            foreach ($data['clients'] as $client) {
                if ('Outlet_' . $extra['ClientID'] === $client['ExternalAPIRef']) {
                    $extras[] = [
                        'Name' => $extra['Name'],
                        'Value' => $extra['Value'],
                        'ClientID' => $client['ClientID']
                    ];
                }
            }
        }

        $data['extras'] = $extras;

        $this->clientExtraService->create($data['extras']);

        unset($data['extras']);

        return $next($data);
    }
}