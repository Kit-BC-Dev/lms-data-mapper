<?php

namespace App\Jobs;

use App\Repositories\UKAccountRepository;
use App\Services\ClientService;
use App\Traits\DataMapper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapUKAccountMainPersonChunkJob implements ShouldQueue
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
        UKAccountRepository $uKAccountRepository,
        ClientService $clientService
    ): void
    {
        $accounts = $uKAccountRepository->getChunk($this->ids);
        $personExternalReference = [];
        foreach ($accounts as $account) {
            if (!in_array('Person_' . $account->MainPersonFK, $personExternalReference)) {
                $personExternalReference[] = 'Person_' . $account->MainPersonFK;
            }
        }

        $person = $this->doMapPeople($clientService->getByExternalApiRefs($personExternalReference));

        foreach ($accounts as $account) {
            $clients[] = [
                'ExternalAPIRef' => 'Account_' . $account->AccountID,
                'ParentClientID' => $person['Person_' . $account->MainPersonFK]['PersonID'] ?? 0
            ];
        }

        $clientService->create($clients);

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'Accounts',
        ]);
    }
}
