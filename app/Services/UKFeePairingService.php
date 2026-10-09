<?php

namespace App\Services;

use App\Repositories\UKFeePairingRepository;

class UKFeePairingService
{
    public function __construct(protected UKFeePairingRepository $uKFeePairingRepository){}

    public function get()
    {
        return $this->uKFeePairingRepository->get();
    }
}