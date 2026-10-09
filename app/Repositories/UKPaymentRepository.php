<?php

namespace App\Repositories;

use App\Models\Payments\UKPayment;

class UKPaymentRepository extends BaseUKRepository
{
    public function __construct(UKPayment $uKPayment)
    {
        parent::__construct(
            $uKPayment,
            'PaymentID',
            ['type']
        );
    }
}