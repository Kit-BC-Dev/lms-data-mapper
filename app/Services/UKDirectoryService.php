<?php

namespace App\Services;

use App\Jobs\MapUKDirectoryChunkJob;
use App\Repositories\UKDirectoryRepository;

class UKDirectoryService extends BaseUKService
{
    public function __construct(private UKDirectoryRepository $uKDirectoryRepository)
    {
        parent::__construct(
            $uKDirectoryRepository,
            MapUKDirectoryChunkJob::class,
            'OutletID',
            1000,
            'directory'
        );
    }

}