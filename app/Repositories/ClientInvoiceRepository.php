<?php

namespace App\Repositories;

use App\Models\Invoices\ClientInvoice;

class ClientInvoiceRepository
{
    public function __construct(protected ClientInvoice $clientInvoice){}

    public function updateOrCreate(array $data)
    {
        foreach (array_chunk($data, 1000) as $chunk) {
            $this->clientInvoice->upsert(
                $chunk,
                ['ExternalReference']
            );
        }
    }

    public function getByExternalReference(array $references)
    {
        return $this->clientInvoice
        ->select('ClientInvoiceID', 'ExternalReference')
        ->whereIn('ExternalReference', $references)
        ->get();
    }
}