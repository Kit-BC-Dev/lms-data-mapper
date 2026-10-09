<?php

namespace App\Repositories;

use App\Models\Transactions\UKScheduledTransaction;

class UKScheduledTransactionRepository
{
    public function __construct(protected UKScheduledTransaction $uKScheduledTransaction){}

    public function get()
    {
        return $this->uKScheduledTransaction->get();
    }
}