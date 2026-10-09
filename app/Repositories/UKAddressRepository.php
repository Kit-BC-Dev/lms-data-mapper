<?php

namespace App\Repositories;

use App\Models\Addresses\UKAddress;

class UKAddressRepository extends BaseUKRepository
{
    public function __construct(UKAddress $ukAddress)
    {
        parent::__construct(
            $ukAddress,
            'AddressID'
        );
    }
}