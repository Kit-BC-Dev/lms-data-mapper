<?php

namespace App\Repositories;

use App\Models\Invoices\UKInvoice;

class UKInvoiceRepository extends BaseUKRepository
{
    public function __construct(UKInvoice $uKInvoice)
    {
        parent::__construct(
            $uKInvoice,
            'InvoiceID'
        );
    }
}