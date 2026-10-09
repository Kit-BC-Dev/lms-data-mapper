<?php

namespace App\Mapper;

use App\DTO\ClientRelationshipDTO;

class ClientRelationshipMapper
{
    public function map(array $data): ClientRelationshipDTO
    {
        return new ClientRelationshipDTO(
            RelationshipTypeID: $data['RelationshipTypeID'] ?? 0,
            ClientID: $data['ClientID'] ?? 0,
            RelatedClientID: $data['RelatedClientID'] ?? 0
        );
    }
}