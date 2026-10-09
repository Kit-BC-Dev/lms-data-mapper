<?php

namespace App\Jobs;

use App\Mapper\AddressMapper;
use App\Repositories\UKAddressRepository;
use App\Services\AddressService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapUKAddressChunkJob implements ShouldQueue
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
        UKAddressRepository $ukAddressRepository,
        AddressMapper $addressMapper,
        AddressService $addressService
    ): void
    {
        $addresses = $ukAddressRepository->getChunk($this->ids);
    
        foreach ($addresses as $address) {
            $dto = $addressMapper->map($address->toArray());

            $localAddresses[] = $dto->toArray();
        }

        $addressService->create($localAddresses);
    }
}
