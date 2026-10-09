<?php

namespace App\Jobs;

use App\Mapper\PersonMapper;
use App\Models\Clients\Client;
use App\Repositories\UKPersonRepository;
use App\Services\AddressService;
use App\Services\ClientService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapUKPersonChunkJob implements ShouldQueue
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
        UKPersonRepository $uKPersonRepository,
        AddressService $addressService,
        ClientService $clientService,
        PersonMapper $personMapper
    ): void
    {
        $persons = $uKPersonRepository->getChunk($this->ids);

        $addressIDs = $persons->pluck('HomeAddressFK')
                    ->filter(fn ($id) => $id != 0)
                    ->unique()
                    ->values()
                    ->toArray();

        $addresses = $addressService->getByIDs($addressIDs);

        $addresses = $addresses->mapWithKeys(fn ($address) => [
            'Address_' . $address->ExternalReference => [
                'AddressID' => $address->AddressID,
            ],
        ])->all();



        foreach ($persons as $person) {
            $dto = $personMapper->map(array_merge($person->toArray(), [
                'PrimaryAddressID' => $addresses['Address_' . $person->HomeAddressFK]['AddressID'] ?? null,
                'ClientTypeID' => 3
            ]));

            $clientPersons[] = $dto->toArray();
        }
        
        $clientService->create($clientPersons);
    }
}
