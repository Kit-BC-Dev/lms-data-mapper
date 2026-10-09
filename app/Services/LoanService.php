<?php

namespace App\Services;

use App\Repositories\LoanRepository;

class LoanService
{
    public function __construct(private LoanRepository $loanRepository){}

    public function create(array $data)
    {
        $this->loanRepository->updateOrCreate($data);
    }
}