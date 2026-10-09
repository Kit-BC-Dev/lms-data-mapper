<?php

namespace App\Mapper;

use App\DTO\ConfigAccountStatusDTO;

class ConfigAccountStatusMapper
{
    public function map(array $data): ConfigAccountStatusDTO
    {
        return new ConfigAccountStatusDTO(
            Name: $data['AccountStatus'],
            DisplayName: $data['AccountStatus'],
            Description: $data['Description'],
            BuyEnabled: (int)$data['BuyEnabled'],
            SellEnabled: (int)$data['SellEnabled'],
            InDirectory: (int)$data['InDirectory'],
            Active: (int)$data['Active'],
            DateCreated: $data['Created'],
            DateModified: $data['Modified']
        );
    }
}