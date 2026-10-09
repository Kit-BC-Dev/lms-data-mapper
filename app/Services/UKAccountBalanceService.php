<?php

namespace App\Services;

use App\Jobs\MapUKAccountBalancesChunkJob;
use App\Repositories\UKAccountBalancesRepository;

class UKAccountBalanceService extends BaseUKService
{
    public function __construct(UKAccountBalancesRepository $uKAccountBalancesRepository)
    {
        parent::__construct(
            $uKAccountBalancesRepository,
            MapUKAccountBalancesChunkJob::class,
            'AccountFK',
            2500,
            'account-balance'
        );
    }

}