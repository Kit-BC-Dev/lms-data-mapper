<?php

namespace App\Repositories;

use App\Models\Invoices\UKInvoiceSeries;

class UKInvoiceSeriesRepository
{
    public function __construct(protected UKInvoiceSeries $uKInvoiceSeries){}

    public function get()
    {
        return $this->uKInvoiceSeries->get();
    }
}