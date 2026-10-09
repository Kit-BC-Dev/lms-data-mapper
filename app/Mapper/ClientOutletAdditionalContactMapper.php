<?php

namespace App\Mapper;

use App\DTO\ClientOutletAdditionalContactDTO;

class ClientOutletAdditionalContactMapper
{
    public function map(array $data): ClientOutletAdditionalContactDTO
    {
        return new ClientOutletAdditionalContactDTO(
            ClientID: $data['ClientID'] ?? null,
            Title: $data['Title'] ?? null,
            FirstName: $data['FirstName'] ?? null,
            LastName: $data['LastName'] ?? null,
            Email: $data['Email'] ?? null,
            BusinessName: $data['BusinessName'] ?? null,
            Role: $data['Role'] ?? null,
            BusinessPhone: $data['BusinessPhone'] ?? null,
            HomePhone: $data['HomePhone'] ?? null,
            Mobile: $data['Mobile'] ?? null,
            Fax: $data['Fax'] ?? null,
        );
    }
}