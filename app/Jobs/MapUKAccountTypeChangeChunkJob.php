<?php

namespace App\Jobs;

use App\Mapper\FieldHistoryMapper;
use App\Repositories\UKAccountTypeChangeRepository;
use App\Services\ClientService;
use App\Services\FieldHistoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;

class MapUKAccountTypeChangeChunkJob implements ShouldQueue
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
        UKAccountTypeChangeRepository $uKAccountTypeChangeRepository,
        ClientService $clientService,
        FieldHistoryService $fieldHistoryService,
        FieldHistoryMapper $fieldHistoryMapper
    ): void
    {
        $typeChanges = $uKAccountTypeChangeRepository->getChunk($this->ids);

        $accountIDs = $this->doMapAccountIDs($typeChanges);

        $accounts = $this->doMapAccount(
            $clientService->getByExternalApiRefs($accountIDs)
        );

        $accountTypeChanges = [];

        foreach ($typeChanges as $type) {
            $dto = $fieldHistoryMapper->map([
                'ExternalReference' => 'AccountTypeChange_' . $type->AccountTypeChangeID,
                'ExternalID' => $accounts['Account_' . $type->AccountFK]['AccountID'],
                'Table' => 'Clients',
                'Field' => 'ClientAccountType',
                'OldValue' => $type->OldType,
                'NewValue' => $accounts['Account_' . $type->AccountFK]['ClientAccountType'],
                'DateCreated' => $type->Created,
                'Modified' => $type->Created
            ]);

            $accountTypeChanges[] = $dto->toArray();
        }

        $fieldHistoryService->create($accountTypeChanges);

        logger()->info([
            'mapped_so_far' => $this->total,
            'table' => 'DBUKAccountTypeChanges',
        ]);
    }
}
