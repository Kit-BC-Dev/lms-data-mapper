<?php

namespace App\Console\Commands;

use App\Services\UKTransactionService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-ttct')]
#[Description('Command description')]
class MapUKTransactionToClientTransactionsTable extends Command
{
    public function __construct(protected UKTransactionService $uKTransactionService){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Transactions to Client Transactions table...');

        $this->uKTransactionService->doMap();

        
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
