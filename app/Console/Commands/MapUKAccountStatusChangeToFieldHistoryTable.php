<?php

namespace App\Console\Commands;

use App\Services\UKAccountStatusChangeService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-status-change')]
#[Description('Map data from UK database table DBUKAccountStatusChanges into BMS Field History Table')]
class MapUKAccountStatusChangeToFieldHistoryTable extends Command
{
    public function __construct(protected UKAccountStatusChangeService $uKAccountStatusChangeService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Account Status Change to Field History table...');

        $this->uKAccountStatusChangeService->doMap();

        
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
    
}
