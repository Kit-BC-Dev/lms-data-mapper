<?php

namespace App\Jobs;

use App\Mapper\FieldHistoryMapper;
use App\Repositories\UKTransactionsAuditRepository;
use App\Services\ClientService;
use App\Services\ClientTransactionService;
use App\Services\FieldHistoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;
class MapUKTransactionsAuditChunkJob implements ShouldQueue
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
        UKTransactionsAuditRepository $uKTransactionsAuditRepository,
        ClientTransactionService $clientTransactionService,
        FieldHistoryService $fieldHistoryService,
        FieldHistoryMapper $fieldHistoryMapper
    ): void
    {
        $audits = $uKTransactionsAuditRepository->getChunk($this->ids);
        $transactionIDs = [];
        foreach ($audits as $audit) {
            if(!in_array($audit->TransactionFK, $transactionIDs)) {
                $transactionIDs[] = $audit->TransactionFK;
            }
        }

        $transactions = $clientTransactionService->getByReference($transactionIDs);

        $transactions = $transactions->mapWithKeys(fn ($clientTransaction) => [
            'ClientTransaction_' . $clientTransaction->ExternalReference => [
                'ClientTransactionID' => $clientTransaction->ClientTransactionID,
            ],
        ])->all();

        $clientTransactions = [];
        foreach ($audits as $audit) {
            $dto = $fieldHistoryMapper->map([
                'ExternalReference' => 'TransactionsAudit_' . $audit->TransactionsAuditID,
                'ExternalID' => $transactions['ClientTransaction_' . $audit->TransactionFK]['ClientTransactionID'],
                'Table' => 'ClientTransactions',
                'Field' => $audit->FieldModified,
                'OldValue' => $audit->OldType,
                'NewValue' => $audit->NewValue,
                'DateCreated' => $audit->Created,
                'Modified' => $audit->Created
            ]);

            $clientTransactions[]  = $dto->toArray();
        }


        $fieldHistoryService->create($clientTransactions);

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'ClientTransactions audit',
        ]);
    }
}
