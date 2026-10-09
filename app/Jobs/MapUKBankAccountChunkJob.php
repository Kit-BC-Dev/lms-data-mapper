<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Repositories\UKBankAccountRepository;

use DB;
use App\Services\ClientService;
use App\Services\ClientBankService;
use App\Mapper\ClientBankMapper;

use App\Traits\DataMapper;


class MapUKBankAccountChunkJob implements ShouldQueue
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
        UKBankAccountRepository $uKBankAccountRepository,
        ClientService $clientService,
        ClientBankService $clientBankService,
        ClientBankMapper $clientBankMapper
    ): void
    {
        $bankAccounts = $uKBankAccountRepository->getChunk($this->ids);

        foreach ($bankAccounts as $bankaccount) {
            $data['bankAccounts'][] = $bankaccount->toArray();
            $data['AccountIDs'][] = 'Account_' . $bankaccount->AccountFK;
        }

        DB::transaction(function () use ($data, $clientService, $clientBankService, $clientBankMapper) {
            $mappedAccounts = $this->doMapAccount($clientService->getByExternalApiRefs($data['AccountIDs']));
            $clientBankAccounts = [];
            foreach ($data['bankAccounts'] as $bankAccount) {
                $dto = $clientBankMapper->map($bankAccount, $mappedAccounts['Account_' . $bankAccount['AccountFK']]['AccountID']);

                $clientBankAccounts[] = $dto->toArray();
            }

            $clientBankService->create($clientBankAccounts);
        });

        logger()->info([
            'mapped_so_far' => $this->total,
            'table' => 'client_banks',
        ]);


    }
}
