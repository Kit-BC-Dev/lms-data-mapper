<?php

namespace App\Console\Commands;

use App\Services\ConfigInvoiceSeriesService;
use App\Services\UKInvoiceSeriesService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-invoice-series')]
#[Description('Map data from UK DBUKInvoiceSeries to BMS ConfigInvoiceSeries table')]
class MapUKInvoiceSeriesToConfigInvoiceSeriesTable extends Command
{
    public function __construct(
        protected UKInvoiceSeriesService $uKInvoiceSeriesService,
        protected ConfigInvoiceSeriesService $configInvoiceSeriesService
    ) {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Invoice Series to Config Invoice Series table...');

        $invoiceSeries = $this->uKInvoiceSeriesService->get();

        foreach ($invoiceSeries as $series) {
            $configInvoiceSeries[] = [
                'ExternalReference' => 'InvoiceSeries_' . $series->InvoiceSeriesID,
                'SeriesName' => $series->SeriesName,
                'SeriesStartDate' => $series->SeriesStartDate,
                'SeriesEndDate' => $series->SeriesEndDate,
                'SeriesMonth' => $series->SeriesMonth,
                'SeriesYear' => $series->SeriesYear,
                'IsCurrent' => $series->IsCurrent,
                'DateClosed' => $series->DateClosed,
                'DateCreated' => $series->Created,
                'DateModified' => $series->Modified,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration',
            ];
        }

        $this->configInvoiceSeriesService->create($configInvoiceSeries);

        
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
