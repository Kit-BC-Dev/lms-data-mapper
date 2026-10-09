<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Services\UKRegionService;
use App\Services\ConfigRegionService;

#[Signature('app:map-cr')]
#[Description('Command description')]
class MapUKRegionToConfigRegionTable extends Command
{
    public function __construct(
        protected UKRegionService $uKRegionService,
        protected ConfigRegionService $configRegionService
    )
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Regions to Config Regions table...');

        $ukRegions = $this->uKRegionService->get();

        foreach ($ukRegions as $region) {
            $this->configRegionService->create([
                'Region' => $region->Region,
                'ExternalReference' => $region->RegionID,
                'Order' => $region->OrderIndex ?? 0,
                'Active' => $region->Active ? 1 : 0,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration'
            ]);
        }

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
