<?php

namespace App\Services;

use App\Jobs\MapUKTransactionFeeRateChunkJob;
use App\Repositories\UKTransactionFeeRateRepository;

class UKTransactionFeeRateService extends BaseUKService
{
    public function __construct(private UKTransactionFeeRateRepository $uKTransactionFeeRateRepository)
    {
        parent::__construct(
            $uKTransactionFeeRateRepository,
            MapUKTransactionFeeRateChunkJob::class,
            'FeeRateID',
            5000,
            'transaction-fee-rate'
        );
    }
}