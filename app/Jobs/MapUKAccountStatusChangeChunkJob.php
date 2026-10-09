<?php

namespace App\Jobs;

use App\Mapper\FieldHistoryMapper;
use App\Repositories\UKAccountStatusChangeRepository;
use App\Services\ClientService;
use App\Services\FieldHistoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;

class MapUKAccountStatusChangeChunkJob implements ShouldQueue
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
        UKAccountStatusChangeRepository $uKAccountStatusChangeRepository,
        ClientService $clientService,
        FieldHistoryService $fieldHistoryService,
        FieldHistoryMapper $fieldHistoryMapper
    ): void
    {
        $statuses = $uKAccountStatusChangeRepository->getChunk($this->ids);
        $accountIDs = $this->doMapAccountIDs($statuses);

        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        foreach ($statuses as $status) {
            $dto = $fieldHistoryMapper->map([
                'ExternalReference' => 'AccountStatusChange_' . $status->AccountStatusChangeID,
                'ExternalID' => $accounts['Account_' . $status->AccountFK]['AccountID'],
                'Table' => 'Clients',
                'Field' => 'ClientAccountStatus',
                'OldValue' => $status->OldStatus,
                'NewValue' => $accounts['Account_' . $status->AccountFK]['ClientAccountStatus'],
                'DateCreated' => $status->Created,
                'Modified' => $status->Created
            ]);

            $fieldHistory[] = $dto->toArray();
        }

        $fieldHistoryService->create($fieldHistory);

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'DBUKAccountStatusChanges',
        ]);

    }
}
