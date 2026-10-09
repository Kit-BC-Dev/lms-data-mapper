<?php

namespace App\Console\Commands;

use App\Services\UKAccountWebSearchService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-client-manager')]
#[Description('Command description')]
class MapUKAccountWebSearchBrokerToClientsTable extends Command
{
    public function __construct(
        private UKAccountWebSearchService $uKAccountWebSearchService
    )
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping manager to clients table');

        $this->uKAccountWebSearchService->doMap();

        $this->info("DONE! DONE! DONE!");
    }
}
