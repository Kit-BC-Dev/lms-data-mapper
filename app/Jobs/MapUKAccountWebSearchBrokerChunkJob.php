<?php

namespace App\Jobs;

use App\Repositories\UKAccountWebSearchRepository;
use App\Services\ClientService;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapUKAccountWebSearchBrokerChunkJob implements ShouldQueue
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
        UKAccountWebSearchRepository $uKAccountWebSearchRepository,
        UserService $userService,
        ClientService $clientService
    ): void
    {
        $accounts = $uKAccountWebSearchRepository->getChunk($this->ids);
        $externalReference = [];
        foreach ($accounts as $account) {
            if (!in_array('Broker_' . $account->Broker, $externalReference)) {
                $externalReference[] = 'Broker_' . $account->Broker;
            }
        }

        $users = $userService->getUserByExternalReference($externalReference)->mapWithKeys(fn ($user) => [
            $user->ExternalReference => [
                'UserID' => $user->UserID,
            ],
        ])->all();

        foreach ($accounts as $account) {
            $clients[] = [
                'ExternalAPIRef' => 'Account_' . $account->AccountID,
                'ManagerID' => $users['Broker_' . $account->Broker]['UserID']
            ];
        }

        $clientService->create($clients);
    }
}
