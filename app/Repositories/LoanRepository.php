<?php

namespace App\Repositories;

use App\Models\Loans\Loan;

class LoanRepository
{
    public function __construct(private Loan $loan){}

    public function updateOrCreate(array $data)
    {
        foreach (array_chunk($data, 1000) as $chunk) {
            $this->loan->upsert(
                $chunk,
                ['ExternalReference']
            );
        }
    }

    
}