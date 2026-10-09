<?php

namespace App\Services;

use App\DTO\ClientRelationshipDTO;
use App\Repositories\ClientRelationshipRepository;

class ClientRelationshipService
{
    public function __construct(protected ClientRelationshipRepository $clientRelationshipRepository){}

    public function create(array $clientRelationshipts)
    {
        $this->clientRelationshipRepository->updateOrCreate($clientRelationshipts);
    }
}