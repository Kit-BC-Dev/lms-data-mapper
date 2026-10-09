<?php

namespace App\Services;

use App\Jobs\MapUKAccountStatusChangeChunkJob;
use App\Repositories\UKAccountStatusChangeRepository;

class UKAccountStatusChangeService extends BaseUKService
{
    public function __construct(protected UKAccountStatusChangeRepository $uKAccountStatusChangeRepository)
    {
        parent::__construct(
            $uKAccountStatusChangeRepository,
            MapUKAccountStatusChangeChunkJob::class,
            'AccountStatusChangeID',
            2500,
            'account-status-change'
        );
    }
}