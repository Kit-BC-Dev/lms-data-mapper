<?php

namespace  App\Mapper;

use App\DTO\ClientExtraDTO;

class ClientExtraMapper
{
    public function map(array $clientExtra): ClientExtraDTO
    {
        return new ClientExtraDTO(
            Value: $clientExtra['Value'] ?? '',
            Name: $clientExtra['Name'] ?? '',
            ClientID: $clientExtra['ClientID'] ?? null,
        );
    }
}