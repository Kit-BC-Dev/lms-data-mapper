<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Repositories\UKAccountRepository;
use DB;
use App\Traits\DataMapper;
use App\Services\ClientExtraService;
use App\Services\ClientService;
use App\Mapper\ClientExtraMapper;

class MapUKAccountDetailsChunkJob implements ShouldQueue
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

        DB::connection('mysql_staging')->transaction( function () use ($data, $clientExtraService, $clientExtraMapper, $clientService) {
            $mappedAccounts = $this->doMapAccount($clientService->getByExternalApiRefs($data['AccountIDs']));
            $clientExtraData = [];
           

            foreach ($data['Accounts'] as $account) {
                $accountID = $mappedAccounts['Account_' . $account['AccountID']]['AccountID'];
                $clients[] = ['FirstName' => $account['CardName'], 'ExternalAPIRef' => 'Account_' . $account['AccountID']];

                $dto = $clientExtraMapper->map([
                    'Name' => 'BusinessTypeID',
                    'Value' => $account['details']['BusinessType'],
                    'ClientID' => $accountID
                ]);
                $clientExtraData[] = $dto->toArray();

                $dto = $clientExtraMapper->map([
                    'Name' => 'RegisteredEntityType',
                    'Value' => $account['details']['BusinessType'],
                    'ClientID' => $accountID
                ]);

                $clientExtraData[] = $dto->toArray();

                $dto = $clientExtraMapper->map([
                    'Name' => 'RegisteredTradingName',
                    'Value' => $account['CardName'],
                    'ClientID' => $accountID
                ]);

                $clientExtraData[] = $dto->toArray();

                $dto = $clientExtraMapper->map([
                    'Name' => 'ABN',
                    'Value' => $account['details']['BusinessRegistrationNumber'] ? $account['details']['BusinessRegistrationNumber'] : $account['details']['ACN'],
                    'ClientID' => $accountID
                ]);
                $clientExtraData[] = $dto->toArray();

                $dto = $clientExtraMapper->map([
                    'Name' => 'Website',
                    'Value' => $account['trading']['WebURL'],
                    'ClientID' => $accountID
                ]);
                $clientExtraData[] = $dto->toArray();


                $dto = $clientExtraMapper->map([
                    'Name' => 'RegisteredCompanyEntity',
                    'Value' => $account['BusinessName'],
                    'ClientID' => $accountID
                ]);
                $clientExtraData[] = $dto->toArray();

            }
            $clientExtraService->create($clientExtraData);
            $clientService->create($clients);
        });

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'AccountDetails'
        ]);
    }
}
