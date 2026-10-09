<?php

namespace App\Services;

use App\DTO\ClientServiceDTO;
use App\Repositories\ClientServiceRepository;
class ClientServiceService
{
    public function __construct(protected ClientServiceRepository $ClientServiceRepository){}

    public function create(array $clientServices)
    {
        $this->ClientServiceRepository->updateOrCreate($clientServices);
    }
}