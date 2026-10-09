<?php

namespace App\Jobs;

use App\Pipelines\ClientDirectoryPipeline;
use App\Pipelines\ClientExtraPipeline;
use App\Pipelines\ClientPipeline;
use App\Pipelines\ClientRelationshipPipeline;
use App\Pipelines\ClientServicePipeline;
use App\Pipelines\ReferencePointPipeline;
use App\Pipelines\SpielPipeline;
use App\Pipelines\ClientOutletAdditionalContactPipeline;
use App\Repositories\UKDirectoryRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

class MapUKDirectoryChunkJob implements ShouldQueue
{
    use Queueable;

    public int $timeout = 300;

    public int $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKDirectoryRepository $ukRepository,
    ): void
    {
        $directories = $ukRepository->getChunk($this->ids);
        $outlets = [];
        foreach ($directories as $directory) {
            $outlets['outlets'][] = $directory;
            $outlets['addresses'][] = $directory->LocationAddressFK;
            $outlets['accounts'][] = 'Account_' . $directory->AccountFK;
            $outlets['extras'][] = [
                'Value' => $directory->WebURL,
                'Name' => 'WebURL',
                'ClientID' => $directory->OutletID
            ];

            $outlets['extras'][] = [
                'Value' => 0,
                'Name' => 'TradeStatus',
                'ClientID' => $directory->OutletID
            ];
            if ($directory->spiel) {
                $outlets['spiels'][] = $directory->spiel;
            }

            if (count($directory->products) > 0) {
                $outlets['products'][] = [
                    'products' => $directory->products,
                    'account' => 'Account_' . $directory->AccountFK
                ];
            }

            foreach ($directory->people as $people) {
                $outlets['outletPeople'][] = [
                    'person' => $people,
                    'outlet' => $directory->OutletID,
                ];
                $outlets['personRefID'][] = 'Person_' . $people->PersonFK;
              
            }
          
        }

        DB::connection('mysql_staging')->transaction(function () use ($outlets) {
          
            app(Pipeline::class)
            ->send($outlets)
            ->through([
                ClientPipeline::class,
                ClientExtraPipeline::class,
                ClientRelationshipPipeline::class,
                ClientOutletAdditionalContactPipeline::class,
                SpielPipeline::class,
                ClientDirectoryPipeline::class,
                ReferencePointPipeline::class,
                ClientServicePipeline::class,
            ])->thenReturn();
        });
        
        logger()->info('Progress', [
            'mapped_so_far' => $this->total,
            'chunk_size' => count($directories),
            'first' => $directories[0],
            'last' => end($directories),
            'table' => 'directory',
        ]);

    }
}
