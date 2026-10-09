<?php

namespace App\Services;

use App\Jobs\MapUKAddressChunkJob;
use App\Repositories\UKAddressRepository;

class UKAddressService extends BaseUKService
{
    public function __construct(UKAddressRepository $ukAddressRepository)
    {
        parent::__construct(
            $ukAddressRepository,
            MapUKAddressChunkJob::class,
            'AddressID',
            5000,
            'address'
        );
    }
}