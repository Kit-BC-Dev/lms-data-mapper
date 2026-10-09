<?php

namespace App\Services;

use App\Repositories\ClientInvoiceRepository;

class ClientInvoiceService
{
    public function __construct(protected ClientInvoiceRepository $clientInvoiceRepository){}

    public function create(array $data)
    {
        $this->clientInvoiceRepository->updateOrCreate($data);
    }

    public function getByRegetByExternalReferenceference(array $references)
    {
        $this->clientInvoiceRepository->getByExternalReference($references);
    }
}