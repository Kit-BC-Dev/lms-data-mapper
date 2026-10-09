<?php

namespace App\Services;

use App\DTO\DirectoryDTO;
use App\Repositories\ClientDirectoryRepository;

class ClientDirectoryService
{
    public function __construct(protected ClientDirectoryRepository $clientDirectoryRepository){}

    public function create(array $directories)
    {
        $this->clientDirectoryRepository->updateOrCreate($directories);
    }

    public function getByReference(array $references)
    {
        return $this->clientDirectoryRepository->getByReference($references);
    }
}