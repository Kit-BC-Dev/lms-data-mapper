<?php

namespace App\Mapper;

use App\DTO\AccountDTO;

class AccountMapper
{
    public function map(array $data): AccountDTO
    {
        return new AccountDTO(
            ExternalAPIRef: 'Account_' . $data['AccountID'] ?? null,
            FirstName: $data['BusinessName'] ?? null,
            AccountNumber: $data['AccountNumber'] ?? null,
            PrimaryAddressID: $data['PrimaryAddressID'] ?? null,
            ClientTypeID: $data['ClientTypeID'] ?? null,
            DateCreated: $data['Created'] ?: null,
            DateModified: $data['Modified'] ?: null,
            CreatedBy: 'migration',
            ModifiedBy: 'migration',
        );
    }
}