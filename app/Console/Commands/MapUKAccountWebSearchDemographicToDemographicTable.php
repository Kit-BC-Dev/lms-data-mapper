<?php

namespace App\Console\Commands;

use App\Services\DemographicService;
use App\Services\UKAccountWebSearchService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-demographic')]
#[Description('Command description')]
class MapUKAccountWebSearchDemographicToDemographicTable extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(
        DemographicService $demographicService,
        UKAccountWebSearchService $uKAccountWebSearchService
    )
    {
        $this->info('Mapping Account Web Search Demographic Data from UK to Demographic Table');
        $demographics = $uKAccountWebSearchService->getDemographicsToMap();

        foreach ($demographics as $demographic) {
            $demographicService->create([
                'Name' => $demographic,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration'

            ]);
        }

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
