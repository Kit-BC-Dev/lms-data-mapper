<?php

namespace App\Services;

use App\Jobs\MapUKInvoiceChunkJob;
use App\Repositories\UKInvoiceRepository;

class UKInvoiceService extends BaseUKService
{
    public function __construct(UKInvoiceRepository $uKInvoiceRepository)
    {
        parent::__construct(
            $uKInvoiceRepository,
            MapUKInvoiceChunkJob::class,
            'InvoiceID',
            10000,
            'client-invoice'
        );
    }
}