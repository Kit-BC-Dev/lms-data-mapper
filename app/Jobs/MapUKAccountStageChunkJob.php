<?php

namespace App\Jobs;

use App\Mapper\ClientExtraMapper;
use App\Repositories\UKAccountStageRepository;
use App\Services\ClientExtraService;
use App\Services\ClientService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;
class MapUKAccountStageChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;

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
        UKAccountStageRepository $uKAccountStageRepository,
        ClientService $clientService,
        ClientExtraService $clientExtraService,
        ClientExtraMapper $clientExtraMapper
    ): void
    {
        $stages = $uKAccountStageRepository->getChunk($this->ids);

        $accountIDs = $this->doMapAccountIDs($stages);

        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        $clientExtras = [];

        foreach ($stages as $stage) {
            $dto = $clientExtraMapper->map([
                'Name' => 'Stage',
                'ClientID' => $accounts['Account_' . $stage->AccountFK]['AccountID'],
                'Value' => $stage->Stage
            ]);

            $clientExtras[] = $dto->toArray();

            $dto = $clientExtraMapper->map([
                'Name' => 'StageDate',
                'ClientID' => $accounts['Account_' . $stage->AccountFK]['AccountID'],
                'Value' => $stage->StageDate
            ]);

            $clientExtras[] = $dto->toArray();
        }

        $clientExtraService->create($clientExtras);
    }
}
