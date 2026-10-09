<?php

namespace App\Services;

use App\Jobs\MapUKAccountDetailsChunkJob;
use App\Jobs\MapUKAccountGroupingChunkJob;
use App\Jobs\MapUKAccountMainPersonChunkJob;
use App\Jobs\MapUKAccountsChunkJob;
use App\Jobs\MapUKDemographicChunkJob;
use App\Repositories\UKAccountRepository;
use InvalidArgumentException;

class UKAccountService
{
    public function __construct(
        protected UKAccountRepository $repository
    ) {}

    public function doMap(string $table = 'AccountGroupings'): void
    {
        $total = 0;

        $this->repository->chunkIds(1000, function ($records) use (&$total, $table) {
            $ids = $records->pluck('AccountID')->toArray();

            $total += count($ids);

            match ($table) {
                'AccountGroupings' => MapUKAccountGroupingChunkJob::dispatch($ids, $total),
                'AccountDetails'   => MapUKAccountDetailsChunkJob::dispatch($ids, $total)->onQueue('account-details'),
                'Demographic'      => MapUKDemographicChunkJob::dispatch($ids, $total),
                'Accounts'         => MapUKAccountsChunkJob::dispatch($ids, $total)->onQueue('accounts'),
                'Parent'           => MapUKAccountMainPersonChunkJob::dispatch($ids, $total)->onQueue('account-parent'),

                default => throw new InvalidArgumentException(
                    "Unknown table: {$table}"
                ),
            };
        });
    }
}