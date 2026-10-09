<?php

namespace App\Jobs;

use App\Mapper\ClientTransactionMapper;
use App\Services\ClientTransactionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Repositories\UKTransactionRepository;
use App\Services\ClientService;
use App\Services\CardService;

use App\Traits\DataMapper;
use DB;

class MapUKTransactionChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;
    private $transactionStatus;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
        $this->transactionStatus = [
            'A' => 1,
            'C' => 2,
            'D' => 3,
            'E' => 4,
            'F' => 5,
            'G' => 6,
            'P' => 7,
            'R' => 8,
            'S' => 9
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKTransactionRepository $uKTransactioNRepository,
        ClientService $clientService,
        CardService $cardService,
        ClientTransactionMapper $clientTransactionMapper,
        ClientTransactionService $clientTransactionService
    ): void
    {
        $transactions = $uKTransactioNRepository->getChunk($this->ids);
        $accountIDs = [];
        $cardIDs = [];

        foreach ($transactions as $transaction) {
            if (!in_array('Account_' . $transaction->MerchantAccountFK, $accountIDs) && $transaction->MerchantAccountFK) {
                $accountIDs[] = 'Account_' . $transaction->MerchantAccountFK;
            }

            if (!in_array('Account_' . $transaction->CustomerAccountFK, $accountIDs) && $transaction->CustomerAccountFK) {
                $accountIDs[] = 'Account_' . $transaction->CustomerAccountFK;
            }

            if (!in_array($transaction->MerchantCardFK, $cardIDs) && $transaction->MerchantCardFK) {
                $cardIDs[] = $transaction->MerchantCardFK;
            }

            if (!in_array($transaction->CustomerCardFK, $cardIDs) && $transaction->CustomerCardFK) {
                $cardIDs[] = $transaction->CustomerCardFK;
            }
        }
        
        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        $cards = $this->doMapCards($cardService->getByExternalReference($cardIDs));

        $clientTransactions = [];

        foreach ($transactions as $transaction) {
            $dto = $clientTransactionMapper->map(
                $transaction->toArray(),
                $accounts,
                $cards,
                $this->transactionStatus[$transaction->AuthorisationStatus]
            );

            $clientTransactions[] = $dto->toArray();
        }

        $clientTransactionService->create($clientTransactions);

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'Client Transactions',
        ]);

    }
}
