<?php

namespace App\Jobs;

use App\Repositories\UKAccountStatusAccountNameRepository;
use App\Services\ClientService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapUKAccountStatusAccoutNameChunkJob implements ShouldQueue
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
        UKAccountStatusAccountNameRepository $uKAccountStatusAccountNameRepository,
        ClientService $clientService
    ): void
    {
        $accountStatuses = $uKAccountStatusAccountNameRepository->getChunk($this->ids);

        foreach ($accountStatuses as $accountStatus) {
            if (!$accountStatus->Account->BusinessName) {
                $accounts[] = [
                    'ExternalAPIRef' => 'Account_' . $accountStatus->AccountFK,
                    'FirstName' => $accountStatus->AccountName
                ];
            }
        }

        $clientService->create($accounts);
    }
}
