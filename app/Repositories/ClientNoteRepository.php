<?php

namespace App\Repositories;

use App\Models\Notes\ClientNote;

class ClientNoteRepository
{
    public function __construct(protected ClientNote $clientNote){}

    public function updateOrCreate(array $data)
    {
        $this->clientNote->upsert(
            $data,
            ['ExternalReference']
        );
    }
}