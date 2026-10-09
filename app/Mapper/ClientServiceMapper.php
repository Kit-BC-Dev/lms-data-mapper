<?php

namespace App\Mapper;

use App\DTO\ClientServiceDTO;

class ClientServiceMapper
{
    public function map(array $clientService, ?int $outletID): ClientServiceDTO
    {
        return new ClientServiceDTO(
            ClientID: $outletID ?? 0,
            ClientDirectoryCategoryID: $clientService['product']['category']['ClientDirectoryCategoryID'] ?? 0,
            ExternalReference: $clientService['OutletProductsID'] ?? null,
            ServiceType: $clientService['ProductType'] ?? null,
            AdditionalProductInformation: $clientService['AdditionalProductInformation'] ?? null,
            Status: $clientService['Status'] ?? null,
            NumberOfStars: $clientService['NumberOfStars'] ?? null,
            ContactBroker: $clientService['ContactBroker'] ?? null,
            LimitedSupply: $clientService['LimitedSupply'] ?? null,
            HardcopyDirectory: $clientService['HardcopyDirectory'] ?? null,
            WebDirectory: $clientService['WebDirectory'] ?? null,
            ContactText: $clientService['ContactText'] ?? null,
            Active: isset($clientService['Active']) ? (string) $clientService['Active'] : null,
            DateInactive: $clientService['DateInactive'] ?: null,
            ReasonInactive: $clientService['ReasonInactive'] ?: null,
            Graphic: $clientService['Graphic'] ?: null,
            UseOutletPhone: $clientService['UseOutletPhone'] ?? null,
            ListPhone: $clientService['ListPhone'] ?? null,
            ListFax: $clientService['ListFax'] ?? null,
            ListEmail: $clientService['ListEmail'] ?? null,
            ListWeb: $clientService['ListWeb'] ?? null,
            ListOtherPhone: $clientService['ListOtherPhone'] ?? null,
            UsePostalAddress: $clientService['UsePostalAddress'] ?? null,
            UseStreetAddress: $clientService['UseStreetAddress'] ?? null,
            ListSuburb: $clientService['ListSuburb'] ?? null,
            ListState: $clientService['ListState'] ?? null,
        );
    }
}