<?php

namespace App\Mapper;

use App\DTO\DirectoryDTO;

class DirectoryMapper
{
    public function map(array $directory, ?int $outletParentID, ?int $clientDirectorySpielID): DirectoryDTO
    {
        return new DirectoryDTO(
            ExternalReference: $directory['DirectoryID'] ?? '',
            AccountClientID: $outletParentID ?? 0,
            ClientDirectorySpielID: $clientDirectorySpielID ?? 0,
            Name: $directory['DirectoryName'] ?? '',
            ReasonInactive: $directory['ReasonInactive'] ?? '',
            InternationalListing: $directory['InternationalListing'] ?? 0,
            NationalListing: $directory['NationalListing'] ?? 0,
            RegionalListing: $directory['RegionalListing'] ?? 0,
            ShowAllOutlets: $directory['ShowAllOutlets'] ?? 0,
            Active: $directory['Active'] ?? 0
        );
    }
}