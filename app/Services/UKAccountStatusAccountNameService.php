<?php

namespace App\Services;

use App\Jobs\MapUKAccountStatusAccoutNameChunkJob;
use App\Repositories\UKAccountStatusAccountNameRepository;

class UKAccountStatusAccountNameService extends BaseUKService
{
    public function __construct(protected UKAccountStatusAccountNameRepository $uKAccountStatusAccountNameRepository)
    {
        parent::__construct(
            $uKAccountStatusAccountNameRepository,
            MapUKAccountStatusAccoutNameChunkJob::class,
            'AccountFK',
            2500,
            'account-status'
        );
    }
    
}