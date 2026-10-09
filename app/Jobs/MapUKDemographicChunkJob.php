<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Repositories\UKAccountRepository;
use App\Services\DemographicService;
use App\Services\ClientService;
use App\Services\ClientSourceService;

use DB;

class MapUKDemographicChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKAccountRepository $uKAccountRepository,
        DemographicService $demographicService,
        ClientService $clientService,
        ClientSourceService $clientSourceService,
    ): void
    {
        $accounts = $uKAccountRepository->getChunk($this->ids);

        $brokerages = [];
        $brokers = [];

        foreach ($accounts as $account) {
            
            if ($account->web && !in_array($account->web->Brokerage, $brokerages)) {
                $brokerages[] = $account->web->Brokerage;
            }

            if ($account->web && !in_array($account->web->Broker, $brokers)) {
                $brokers[] = $account->web->Broker;
            }

            $data['accounts'][] = $account;
            $data['AccountIDs'][] = 'Account_' . $account->AccountID;
        }
        $demographics = $demographicService->getDemographicByNames($brokerages);
        $mappedDemographics = [];
        foreach ($demographics as $demographic) {
            $mappedDemographics[strtolower($demographic->Name)] = ['DemographicID' => $demographic->DemographicID];
        }

        $sources = $clientSourceService->getSourceByName($brokers);
        $mappedSources = [];
        foreach ($sources as $source) {
            $mappedSources[strtolower($source->Name)] = ['ClientSourceID' => $source->ClientSourceID];
        }

        DB::connection('mysql_staging')
            ->transaction( function () use ($data, $mappedDemographics, $clientService, $mappedSources) {
                $clients = [];

                foreach ($data['accounts'] as $account) {
                    if ($account->web) {
                        $clients[] = [
                            'DemographicID' => $mappedDemographics[strtolower($account->web->Brokerage)]['DemographicID'],
                            'ClientSourceID' =>  $mappedSources[strtolower($account->web->Broker)]['ClientSourceID'],
                            'ExternalAPIRef' => 'Account_' . $account->AccountID
                        ];
                    }
                }

                $clientService->create($clients);

        });

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'Demographic',
        ]);
    }
}
