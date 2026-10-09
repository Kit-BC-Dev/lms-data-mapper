<?php

namespace App\Repositories;

use App\Models\ClientRelationship\ClientRelationship;
class ClientRelationshipRepository
{
    public function __construct(protected ClientRelationship $clientRelationship){}

    public function updateOrCreate(array $data)
    {
        $this->clientRelationship->upsert(
            $data,
            [
                'ClientID',
                'RelatedClientID',
                'RelationshipTypeID'
            ]
        );
    }
}