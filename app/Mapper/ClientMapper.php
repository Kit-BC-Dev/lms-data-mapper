<?php

namespace App\Mapper;

use App\DTO\ClientDTO;

class ClientMapper
{
    public function map(array $data, string $reference = 'Outlet_', int $clientTypeID = 2): ClientDTO
    {
        return new ClientDTO(
            ParentClientID: $data['ParentClientID'] ?? 0,
            ExternalAPIRef: $reference . $data['OutletID'] ?? 0,
            ClientTypeID: $clientTypeID,
            PrimaryAddressID: $data['PrimaryAddressID'] ?? 0,
            FirstName: $data['OutletName'] ?? '',
            WorkPhoneNumber: $data['OtherPhone'] ?? '',
            MobileNumber: $data['Phone'] ?? '',
            EmailAddress: $data['Email'] ?? '',
            DateCreated: $data['Created'] ?? null,
            DateModified: $data['Modified'] ?? null,
        );
    }
}