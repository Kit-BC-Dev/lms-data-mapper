<?php

namespace App\Services;

use App\Jobs\MapUKPaymentChunkJob;
use App\Repositories\UKPaymentRepository;

class UKPaymentService extends BaseUKService
{
    public function __construct(UKPaymentRepository $uKPaymentRepository)
    {
        parent::__construct(
            $uKPaymentRepository,
            MapUKPaymentChunkJob::class,
            'PaymentID',
            5000,
            'account-payment'
        );
    }
}