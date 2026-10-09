<?php

namespace  App\Mapper;

use App\DTO\AddressDTO;

class AddressMapper
{
    public function map(array $address): AddressDTO
    {
        return new AddressDTO(
            ClientID: $address['OutletID'] ?? 0,
            ExternalReference: $address['AddressID'] ?? null,
            AddressName: $address['AddressLine1'] ?? '',
            UnitNumber: $address['UnitNumber'] ?? '',
            StreetNumber: $address['StreetNumber'] ?? '',
            Address: $address['AddressLine2'] ?? '',
            Suburb: $address['Suburb'] ?? '',
            City: $address['Suburb'] ?? '',
            State: $address['State'] ?? '',
            PostCode: $address['PostCode'] ?? '',
            Country: $address['Country'] ?? ''
        );
    }


}