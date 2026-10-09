<?php

namespace App\Services;

use App\Repositories\UKTransactionRepository;

use App\Jobs\MapUKTransactionChunkJob;
class UKTransactionService extends BaseUKService
{
    public function __construct(UKTransactionRepository $uKTransactionRepository)
    {
        parent::__construct(
            $uKTransactionRepository,
            MapUKTransactionChunkJob::class,
            'TransactionID',
            5000,
            'client-transaction'
        );
    }
}