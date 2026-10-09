<?php

namespace App\Jobs;

use App\Mapper\ClientInvoiceMapper;
use App\Repositories\UKInvoiceRepository;
use App\Services\ClientInvoiceService;
use App\Services\ClientService;
use App\Services\ConfigInvoiceSeriesService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;

class MapUKInvoiceChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKInvoiceRepository $uKInvoiceRepository,
        ClientService $clientService,
        ConfigInvoiceSeriesService $configInvoiceSeriesService,
        ClientInvoiceMapper $clientInvoiceMapper,
        ClientInvoiceService $clientInvoiceService
    ): void
    {
        $invoices = $uKInvoiceRepository->getChunk($this->ids);

        $accountIDs = $this->doMapAccountIDs($invoices);
        $invoiceSeriesIDs = [];

        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        foreach ($invoices as $invoice) {
            if (!in_array('InvoiceSeries_' . $invoice->InvoiceSeriesFK, $invoiceSeriesIDs)) {
                $invoiceSeriesIDs[] = 'InvoiceSeries_' . $invoice->InvoiceSeriesFK;
            }
        }
        $invoiceSeries = $configInvoiceSeriesService->getByExternalReference($invoiceSeriesIDs)
            ->mapWithKeys(fn ($series) => [
            $series->ExternalReference => [
                'InvoiceSeriesID' => $series->InvoiceSeriesID,
            ],
        ])->all();

        $clientInvoices = [];

        foreach ($invoices as $invoice) {
            $dto = $clientInvoiceMapper->map(
                $invoice->toArray(),
                $accounts['Account_' . $invoice->AccountFK]['AccountID'],
                $invoiceSeries['InvoiceSeries_' . $invoice->InvoiceSeriesFK]['InvoiceSeriesID']
            );

            $clientInvoices[] = $dto->toArray();
        }

        $clientInvoiceService->create($clientInvoices);

        logger()->info([
            'data_mapped_so_far' => $this->total
        ]);
    }
}
