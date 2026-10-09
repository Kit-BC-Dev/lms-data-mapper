<?php

namespace App\Console\Commands;

use App\Services\UKTransactionsAuditService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-transactions-audit')]
#[Description('Map data from UK database table DBUKTransactionsAudit into BMS Field History Table')]
class MapUKTransactionsAuditToFieldHistoryTable extends Command
{
    public function __construct(protected UKTransactionsAuditService $uKTransactionsAuditService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Transactions Audit to Field History table...');

        $this->uKTransactionsAuditService->doMap();
        
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
