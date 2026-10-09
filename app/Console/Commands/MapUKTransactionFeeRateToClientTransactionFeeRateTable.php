<?php

namespace App\Console\Commands;

use App\Services\UKTransactionFeeRateService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-fee-rate')]
#[Description('Command description')]
class MapUKTransactionFeeRateToClientTransactionFeeRateTable extends Command
{
    public function __construct(private UKTransactionFeeRateService $uKTransactionFeeRateService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Transaction Fee Rate to Client Transaction Fee Rate Table...');

        $this->uKTransactionFeeRateService->doMap();

        $this->info('Mapping completed successfully.');
    }
}
