<?php

namespace App\Services;

use App\Jobs\MapUKChargesChunkJob;
use App\Repositories\UKChargesRepository;

class UKChargeService extends BaseUKService
{
    public function __construct(protected UKChargesRepository $uKChargesRepository)
    {
        parent::__construct(
            $uKChargesRepository,
            MapUKChargesChunkJob::class,
            'ChargeID',
            5000,
            'account-charge'
        );
    }
}