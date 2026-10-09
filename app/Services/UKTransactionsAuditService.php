<?php

namespace App\Services;

use App\Jobs\MapUKTransactionsAuditChunkJob;
use App\Repositories\UKTransactionsAuditRepository;

class UKTransactionsAuditService extends BaseUKService
{
    public function __construct(UKTransactionsAuditRepository $uKTransactionsAuditRepository)
    {
        parent::__construct(
            $uKTransactionsAuditRepository,
            MapUKTransactionsAuditChunkJob::class,
            'TransactionsAuditID',
            2500,
            'transaction-audit'
        );
    }
}