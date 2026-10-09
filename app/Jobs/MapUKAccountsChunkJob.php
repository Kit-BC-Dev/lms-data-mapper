<?php

namespace App\Jobs;

use App\Pipelines\AccountContactPipeline;
use App\Pipelines\AccountPipeline;
use App\Repositories\UKAccountRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
class MapUKAccountsChunkJob implements ShouldQueue
{
    use Queueable;

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
        UKAccountRepository $uKAccountRepository
    ): void
    {
        $accounts = $uKAccountRepository->getChunk($this->ids);

        DB::transaction(function () use ($accounts) {
            app(Pipeline::class)
                ->send($accounts)
                ->through([
                    AccountPipeline::class,
                    AccountContactPipeline::class
                ])
                ->thenReturn();
        });
    }
}
