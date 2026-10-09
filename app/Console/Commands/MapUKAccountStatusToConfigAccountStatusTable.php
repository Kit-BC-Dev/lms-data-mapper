<?php

namespace App\Console\Commands;

use App\Services\ConfigAccountStatusService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-status')]
#[Description('Command description')]
class MapUKAccountStatusToConfigAccountStatusTable extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(
        ConfigAccountStatusService $configAccountStatusService
    )
    {
        
        $this->info('Mapping UK Cards to Cards table...');
        $configAccountStatusService->create();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
