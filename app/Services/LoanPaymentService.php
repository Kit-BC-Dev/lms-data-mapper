<?php

namespace App\Services;

use App\Repositories\LoanPaymentRepository;

class LoanPaymentService
{
    public function __construct(private LoanPaymentRepository $loanPaymentRepository){}

    public function create(array $data)
    {
        $this->loanPaymentRepository->updateOrCreate($data);
    }
}