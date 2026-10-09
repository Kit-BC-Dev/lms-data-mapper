<?php

namespace App\Services;

use App\Repositories\UKInvoiceSeriesRepository;

class UKInvoiceSeriesService
{
    public function __construct(protected UKInvoiceSeriesRepository $uKInvoiceSeriesRepository){}

    public function get()
    {
        return $this->uKInvoiceSeriesRepository->get();
    }
}