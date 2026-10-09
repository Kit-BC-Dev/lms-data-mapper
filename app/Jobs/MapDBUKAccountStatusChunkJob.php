<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Repositories\UKAccountStatusRepository;
use App\Services\ClientService;

use App\Traits\DataMapper;
use DB;

class MapDBUKAccountStatusChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;
    private $accountTypes = [];
    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
        $this->accountTypes = [
            'A' => [
                'AccountTypeID' => 176
            ],
            'N' => [
                'AccountTypeID' => 70
            ],
            'A11' => [
                'AccountTypeID' => 176
            ],
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKAccountStatusRepository $uKAccountStatusRepository,
        ClientService $clientService
    ): void
    {
        $accountStatuses = $uKAccountStatusRepository->getChunk($this->ids);
        foreach ($accountStatuses as $accountStatus) {
            $data['AccountIDs'][] = 'Account_' . $accountStatus->AccountFK;
            $data['accountStatus'][] = $accountStatus->toArray();
        }

        DB::connection('mysql_staging')->transaction(function () use ($data, $clientService) {
           

            foreach ($data['accountStatus'] as $accountStatus) {
                $accountStatuses[] = [
                    'ClientAccountTypeID' => $accountStatus['type']['ClientAccountTypeID'] ?? $this->accountTypes[$accountStatus['AccountType']]['AccountTypeID'],
                    'ClientAccountStatusID' => $accountStatus['status']['ClientAccountStatusID'],
                    'ClientTypeID' => 1,
                    'ExternalAPIRef' => 'Account_' . $accountStatus['AccountFK'],
                    'DateCreated' => $accountStatus['account']['Modified'],
                    'DateModified' => $accountStatus['account']['Created'],
                    'CreatedBy' => 'migration',
                    'ModifiedBy' => 'migration',
                ];
            }
            $clientService->create($accountStatuses);
        });

        logger()->info([
            'mapped_data_so_far' => $this->total,
            'table' => 'DBUKAccountStatus',
        ]);
    }
}
