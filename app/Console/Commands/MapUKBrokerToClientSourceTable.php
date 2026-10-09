<?php

namespace App\Console\Commands;

use App\Services\ClientSourceService;
use App\Services\UKAccountWebSearchService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-cs')]
#[Description('Command description')]
class MapUKBrokerToClientSourceTable extends Command
{
    public function __construct(
        
        protected ClientSourceService $clientSourceService,
        protected UKAccountWebSearchService $uKAccountWebSearchService
    )
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Client Source to Client Sources table...');

        $sources = $this->uKAccountWebSearchService->getSourcesToMap();
        
        foreach ($sources as $source) {
            $this->clientSourceService->create([
                'Name' => $source,
                'FrontEnd' => 1,
                'Active' => 1,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration'
            ]);
        }


        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
