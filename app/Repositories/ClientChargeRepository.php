<?php

namespace App\Repositories;

use App\Models\Charges\ClientCharge;

class ClientChargeRepository
{
    public function __construct(protected ClientCharge $clientCharge){}

    public function updateOrCreate(array $data)
    {
        foreach (array_chunk($data, 1000) as $chunk) {
            $this->clientCharge->upsert(
                $chunk,
                ['ExternalReference']
            );
        }
    }
}