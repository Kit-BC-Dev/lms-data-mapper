<?php

namespace App\Services;

use App\Repositories\ClientChargeRepository;

class ClientChargeService
{
    public function __construct(protected ClientChargeRepository $clientChargeRepository){}

    public function create(array $data)
    {
        $this->clientChargeRepository->updateOrCreate($data);
    }
}