<?php

namespace App\Console\Commands;

use App\Services\UKInvoiceService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-invoice')]
#[Description('Map data from UK DBUKInvoices to BMS ClientInvoices table')]
class MapUKInvoiceToClientInvoiceTable extends Command
{
    public function __construct(
        protected UKInvoiceService $uKInvoiceService
    ) {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
         $this->info('Mapping UK Invoices to Client Invoices table...');

        $ukRegions = $this->uKInvoiceService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
