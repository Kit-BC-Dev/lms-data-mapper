<?php

namespace App\Services;

use App\Repositories\ClientSourceRepository;

class ClientSourceService
{
    public function __construct(protected ClientSourceRepository $clientSourceRepository){}

    public function create(array $data)
    {
        $this->clientSourceRepository->create($data);
    }

    public function getSourceByName(array $names)
    {
        return $this->clientSourceRepository->getSourcesByName($names);
    }
}