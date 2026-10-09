<?php

namespace App\Mapper;

use App\DTO\PersonDTO;

class PersonMapper
{
    public function map(array $data): PersonDTO
    {
        return new PersonDTO(
            'Person_' . $data['PersonID'] ?? null,
            $data['ClientTypeID'] ?? null,
            $data['PrimaryAddressID'] ?? null,
            $data['GivenName'] ?? null,
            $data['LastName'] ?? null,
            $data['MiddleName'] ?? null,
            $data['Title'] ?? null,
            $data['Email'] ?? null,
            $data['BusinessPhone'] ?? null,
            $data['Mobile'] ?? null,
            $data['HomePhone'] ?? null,
            $data['Created'] ?: null,
            $data['Modified'] ?: null,
            'migration',
            'migration'
        );
    }
}