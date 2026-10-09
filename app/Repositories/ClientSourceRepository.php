<?php

namespace App\Repositories;

use App\Models\Clients\ClientSource;

class ClientSourceRepository
{
    public function __construct(protected ClientSource $clientSource){}

    public function create(array $clientSource)
    {
        $this->clientSource->create($clientSource);
    }

    public function getSourcesByName(array $sources)
    {
        return $this->clientSource->whereIn('Name', $sources)->get();
    }
}