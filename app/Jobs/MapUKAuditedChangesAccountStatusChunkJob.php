<?php

namespace App\Jobs;

use App\Mapper\FieldHistoryMapper;
use App\Repositories\UKAuditedChangesRepository;
use App\Services\ClientService;
use App\Services\ConfigAccountStatusService;
use App\Services\FieldHistoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;
class MapUKAuditedChangesAccountStatusChunkJob implements ShouldQueue
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
        UKAuditedChangesRepository $uKAuditedChangesRepository,
        ClientService $clientService,
        ConfigAccountStatusService $configAccountStatusService,
        FieldHistoryMapper $fieldHistoryMapper,
        FieldHistoryService $fieldHistoryService
    ): void
    {
        $changes = $uKAuditedChangesRepository->getChunk($this->ids);
        $accountIDs = [];
        $displayNames = [];
    
        foreach ($changes as $change) {

            if (!in_array('Account_' . $change->RecordKey, $accountIDs)) {
                $accountIDs[] = 'Account_' . $change->RecordKey;
            }
            if (!in_array($change->OldValue, $displayNames)) {
                $displayNames[] = $change->OldValue;
            }

            if (!in_array($change->NewValue, $displayNames)) {
                $displayNames[] = $change->NewValue;
            }
        }

        $accountStatus = $configAccountStatusService->getByDisplayName($displayNames);
        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        $accountStatus = $accountStatus->mapWithKeys(fn ($status) => [
            'Status_' . $status->DisplayName => [
                'ClientAccountStatusID' => $status->ClientAccountStatusID,
            ],
        ])->all();

        foreach ($changes as $change) {
            $dto = $fieldHistoryMapper->map([
                'ExternalReference' => 'AccountStatusChangeID_' . $change->AuditedChangeID,
                'ExternalID' => $accounts['Account_' . $change->RecordKey]['AccountID'],
                'Table' => 'Clients',
                'Field' => 'ClientAccountStatusID',
                'OldValue' => $accountStatus['Status_' . $change->OldValue]['ClientAccountStatusID'] ?? $accountStatus['Status_' . strtolower($change->OldValue)]['ClientAccountStatusID'],
                'NewValue' => $accountStatus['Status_' . $change->NewValue]['ClientAccountStatusID'] ?? $accountStatus['Status_' . strtolower($change->NewValue)]['ClientAccountStatusID'],
                'DateCreated' => $change->Created,
                'Modified' => $change->Created
            ]);

            $fieldHistory[] = $dto->toArray();
        }

        $fieldHistoryService->create($fieldHistory);

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'TableName' => 'FieldHistory'
        ]);
    }
}
