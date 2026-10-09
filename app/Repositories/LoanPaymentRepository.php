<?php

namespace App\Repositories;

use App\Models\Loans\LoanPayment;

class LoanPaymentRepository
{
    public function __construct(private LoanPayment $loanPayment){}

    public function updateOrCreate(array $data)
    {
        $this->loanPayment->upsert(
            $data,
            ['ExternalAPIRef']
        );
    }
}