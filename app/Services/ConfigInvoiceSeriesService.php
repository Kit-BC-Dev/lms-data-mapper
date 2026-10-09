<?php

namespace App\Services;

use App\Repositories\ConfigInvoiceSeriesRepository;

class ConfigInvoiceSeriesService
{
    public function __construct(protected ConfigInvoiceSeriesRepository $configInvoiceSeriesRepository){}

    public function create(array $data)
    {
        $this->configInvoiceSeriesRepository->updateOrCreate($data);
    }

    public function getByExternalReference(array $references)
    {
        return $this->configInvoiceSeriesRepository->getByExternalReference($references);
    }
}