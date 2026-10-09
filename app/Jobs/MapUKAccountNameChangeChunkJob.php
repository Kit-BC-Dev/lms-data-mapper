<?php

namespace App\Jobs;

use App\Mapper\FieldHistoryMapper;
use App\Repositories\UKAccountNameChangeRepository;
use App\Services\ClientService;
use App\Services\FieldHistoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;

class MapUKAccountNameChangeChunkJob implements ShouldQueue
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
        UKAccountNameChangeRepository $uKAccountNameChangeRepository,
        ClientService $clientService,
        FieldHistoryService $fieldHistoryService,
        FieldHistoryMapper $fieldHistoryMapper
    ): void
    {
        $changes = $uKAccountNameChangeRepository->getChunk($this->ids);
        $accountIDs = [];

        foreach ($changes as $change) {
            if (!in_array('Account_' . $change->AccountFK, $accountIDs)) {
                $accountIDs[] = 'Account_' . $change->AccountFK;
            }
        }

        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs), true);
        $fieldHistory = [];

        foreach ($changes as $change) {
            $dto = $fieldHistoryMapper->map([
                'ExternalReference' => 'AccountNameChange_' . $change->AccountNameChangeID,
                'ExternalID' => $accounts['Account_' . $change->AccountFK]['AccountID'],
                'Table' => 'Clients',
                'Field' => 'FirstName',
                'OldValue' => $change->OldName,
                'NewValue' => $accounts['Account_' . $change->AccountFK]['FirstName'],
                'DateCreated' => $change->Created,
                'Modified' => $change->Created
            ]);

            $fieldHistory[] = $dto->toArray();
        }


        $fieldHistoryService->create($fieldHistory);

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'DBUKAccountNameChanges',
        ]);
    }
}
