<?php

namespace App\Jobs;

use App\Services\ClientExtraService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Repositories\UKAccountRepository;
use App\Mapper\ClientExtraMapper;
use DB;
use App\Traits\DataMapper;
use App\Services\ClientService;

class MapUKAccountGroupingChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;

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
        ClientExtraService $clientExtraService,
        ClientExtraMapper $clientExtraMapper,
        ClientService $clientService

    ): void
    {
        $accounts = $uKAccountRepository->getChunk($this->ids);

        foreach ($accounts as $account) {
            $data['Accounts'][] = $account->toArray();
            $data['AccountIDs'][] = 'Account_' . $account->AccountID; 
        }

      
       
        DB::transaction(function () use ($data, $clientExtraMapper, $clientService, $clientExtraService) {

            $mappedAccounts = $this->doMapAccount($clientService->getByExternalApiRefs($data['AccountIDs']));
            $clientExtras = [];
            foreach ($data['Accounts'] as $account) {

                $dto = $clientExtraMapper->map([
                    'Name' => 'AccountGroupingID',
                    'Value' => $account['AssociatedAccountsID'],
                    'ClientID' => $mappedAccounts['Account_' . $account['AccountID']]['AccountID']
                ]);

                $clientExtras[] = $dto->toArray();
            }

            $clientExtraService->create($clientExtras);

        });

        logger()->info([
            'data_mapped_so_far' => $this->total
        ]);

    }
}
