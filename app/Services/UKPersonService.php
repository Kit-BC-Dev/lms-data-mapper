<?php

namespace App\Services;

use App\Jobs\MapUKPersonChunkJob;
use App\Repositories\UKPersonRepository;

class UKPersonService extends BaseUKService
{
    public function __construct(UKPersonRepository $uKPersonRepository)
    {
        parent::__construct(
            $uKPersonRepository,
            MapUKPersonChunkJob::class,
            'PersonID',
            2500,
            'persons'
        );
    }
}