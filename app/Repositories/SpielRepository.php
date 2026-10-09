<?php

namespace App\Repositories;

use App\Models\Spiel\Spiel;

class SpielRepository
{
    public function __construct(protected Spiel $spiel){}

    public function updateOrCreate(array $data)
    {
        $this->spiel->upsert(
            $data,
            [
                'ExternalReference'
            ]
        );
    }

    public function getSpielsFromReference(array $externalReferenceIDs)
    {
        return $this->spiel->select('ClientDirectorySpielID', 'ExternalReference', 'AccountClientID')->whereIn('ExternalReference', $externalReferenceIDs)->get();
    }
}