<?php

namespace App\Services;

use App\Repositories\UKScheduledTransactionRepository;

class UKScheduledTransactionService
{
    public function __construct(protected UKScheduledTransactionRepository $uKScheduledTransactionRepository){}

    public function get()
    {
        return $this->uKScheduledTransactionRepository->get();
    }
}