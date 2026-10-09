<?php

namespace App\Repositories;

use App\Models\Invoices\ConfigInvoiceSeries;

class ConfigInvoiceSeriesRepository
{
    public function __construct(protected ConfigInvoiceSeries $configInvoiceSeries){}

    public function updateOrCreate(array $data)
    {
        $this->configInvoiceSeries->upsert(
            $data,
            ['ExternalReference']
        );
    }

    public function getByExternalReference(array $references)
    {
        return $this->configInvoiceSeries
        ->select('InvoiceSeriesID', 'ExternalReference')
        ->whereIn('ExternalReference', $references)
        ->get();
    }
}