<?php

namespace App\Services;

use App\Repositories\ClientExtraRepository;

class ClientExtraService
{
    public function __construct(
        protected ClientExtraRepository $clientExtraRepository,
    ){}

    public function create(array $clientExtras)
    {
        $this->clientExtraRepository->createOrUpdate($clientExtras);
    }
}