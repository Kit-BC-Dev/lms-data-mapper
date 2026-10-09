<?php

namespace App\Services;

use App\Jobs\MapDBUKAccountStatusChunkJob;
use App\Repositories\UKAccountStatusRepository;
class UKAccountStatusService extends BaseUKService
{
    public function __construct(protected UKAccountStatusRepository $ukAccountStatusRepository)
    {
        parent::__construct(
            $ukAccountStatusRepository,
            MapDBUKAccountStatusChunkJob::class,
            'AccountFK',
            5000,
            'account-status'
        );
    }
}