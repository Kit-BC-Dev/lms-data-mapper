<?php

namespace App\Services;

use App\Repositories\ClientNoteRepository;

class ClientNoteService
{
    public function __construct(protected ClientNoteRepository $clientNoteRepository){}

    public function create(array $data)
    {
        $this->clientNoteRepository->updateOrCreate($data);
    }
}