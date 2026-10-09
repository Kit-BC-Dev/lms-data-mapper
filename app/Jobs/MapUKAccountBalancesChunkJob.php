<?php

namespace App\Jobs;

use App\Mapper\ClientBalanceMapper;
use App\Repositories\UKAccountBalancesRepository;
use App\Services\ClientBalanceService;
use App\Services\ClientService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Traits\DataMapper;

class MapUKAccountBalancesChunkJob implements ShouldQueue
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
        UKAccountBalancesRepository $uKAccountBalancesRepository,
        ClientService $clientService,
        ClientBalanceService $clientBalanceService,
        ClientBalanceMapper $clientBalanceMapper
    ): void
    {
        $balances = $uKAccountBalancesRepository->getChunk($this->ids);
        $accountIDs = $this->doMapAccountIDs($balances);

        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        $clientBalances = [];

        foreach ($balances as $balance) {
            $dto = $clientBalanceMapper->map($balance->toArray(), $accounts['Account_' . $balance->AccountFK]['AccountID']);

            $clientBalances[] = $dto->toArray();
        }

        $clientBalanceService->create($clientBalances);

        logger()->info([
            'mapped_so_far' => $this->total,
            'table' => 'ClientBalances',
        ]);
    }
}
