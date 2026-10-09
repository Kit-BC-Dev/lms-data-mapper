<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Repositories\UKContactRepository;
use App\Services\ClientService;
use App\Services\ClientNoteService;
use App\Mapper\ClientNoteMapper;

use DB;

use App\Traits\DataMapper;

class MapUKContactV2ChunckJob implements ShouldQueue
{
    use Queueable, DataMapper;

    public int $timeout = 300;

    public int $tries = 3;

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
        UKContactRepository $uKContactRepository,
        ClientService $clientService,
        ClientNoteService $clientNoteService,
        ClientNoteMapper $clientNoteMapper
    ): void
    {
        $contacts = $uKContactRepository->getChunk($this->ids);
        $accountIDs = [];
        $clientNotes = [];
        foreach ($contacts as $contact) {
            if (!in_array($contact->AccountFK, $accountIDs)) {
                $accountIDs[] = 'Account_' . $contact->AccountFK;
            }
        }
    
        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        DB::connection('mysql_staging')->transaction(function () use (
            $contacts, 
            $accounts, 
            $clientNoteMapper,
            $clientNoteService,
            &$clientNotes
        ){

            foreach ($contacts as $contact) {
              
                $dto = $clientNoteMapper->map(
                    $contact->toArray(), 
                    $accounts['Account_' . $contact->AccountFK]['AccountID'] ?? 0
                );

                $clientNotes[] = $dto->toArray();
                
               
            }
            $clientNoteService->create($clientNotes);
        });

        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'Client Notes',
        ]);
    }
}
