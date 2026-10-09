<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class GeocodingService
{
    public function __construct(private ClientRepository $clientRepository){}
    public function doMap()
    {
        $this->clientRepository->getOutletClient(5000, function ($records) {
            $ids = $records->pluck('ClientID')->toArray();
        });
    }
}