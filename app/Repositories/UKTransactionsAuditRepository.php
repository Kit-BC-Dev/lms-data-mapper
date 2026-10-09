<?php

namespace App\Repositories;

use App\Models\History\UKTransactionAudit;

class UKTransactionsAuditRepository extends BaseUKRepository
{
    public function __construct(UKTransactionAudit $uKTransactionAudit)
    {
        parent::__construct(
            $uKTransactionAudit,
            'TransactionsAuditID'
        );
    }
}