<?php

namespace App\Console\Commands;

use App\Services\UKAccountBalanceService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-balance')]
#[Description('Map data from UK database table DBUKAccountBalances into BMS Client Balances Table')]
class MapUKAccountBalancesToClientBalancesTable extends Command
{
    public function __construct(protected UKAccountBalanceService $uKAccountBalanceService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Account Balances Data to Client Balances Table');

        $this->uKAccountBalanceService->doMap();

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
