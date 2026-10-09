<?php

namespace App\Console\Commands;

use App\Services\UKChargeService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-ctcc')]
#[Description('Command description')]
class MapUKChargesToClientChargesTable extends Command
{
    public function __construct(
        protected UKChargeService $uKChargeService
    )
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
         $this->info('Mapping UK Charges to Client Charges table...');

        $this->uKChargeService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
