<?php

namespace App\Jobs;

use App\Mapper\AccountSituationHistoryMapper;
use App\Repositories\UKContactRepository;
use App\Services\AccountSituationHistoryService;
use App\Services\ClientService;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Traits\DataMapper;

use DB;
class MapUKContactChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;

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
        UKContactRepository $uKContactRepository,
        ClientService $clientService,
        AccountSituationHistoryMapper $accountSituationHistoryMapper,
        AccountSituationHistoryService $accountSituationHistoryService
    ): void
    {
        $contacts = $uKContactRepository->getChunk($this->ids);
        $accountIDs = [];
        $accountSituationHistory = [];
        foreach ($contacts as $contact) {
            if (!in_array($contact->AccountFK, $accountIDs)) {
                $accountIDs[] = 'Account_' . $contact->AccountFK;
            }
        }
    
        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        DB::connection('mysql_staging')->transaction(function () use (
            $contacts, 
            $accounts, 
            $accountSituationHistoryMapper,
            $accountSituationHistoryService) {

            foreach ($contacts as $contact) {
              
                $dto = $accountSituationHistoryMapper->map(
                    $contact->toArray(), 
                    $accounts['Account_' . $contact->AccountFK]['AccountID'] ?? 0
                );

                $accountSituationHistory[] = $dto->toArray();
                
               
            }
            $accountSituationHistoryService->create($accountSituationHistory);
        });

        logger()->info([
            'data_mapped_so_far' => $this->total
        ]);
    }
}
