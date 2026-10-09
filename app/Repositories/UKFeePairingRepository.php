<?php

namespace App\Repositories;

use App\Models\Fees\DBUKFeePairing;
use App\Models\Fees\UKFeePairing;

class UKFeePairingRepository
{
    public function __construct(protected UKFeePairing $uKFeePairing){}

    public function get()
    {
        return $this->uKFeePairing->get();
    }
}