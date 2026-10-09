<?php

namespace App\Mapper;

use App\DTO\ConfigClientAccountTypeDTO;
class ConfigClientAccountTypeMapper
{
    public function map(array $data): ConfigClientAccountTypeDTO
    {
        return new ConfigClientAccountTypeDTO(
            Name: $data['AccountType'] ?? null,
            Description: $data['Description'] ?? null,
            IsStaff: isset($data['IsStaff']) ? (bool) $data['IsStaff'] : null,
            SendDirectory: isset($data['SendDirectory']) ? (bool) $data['SendDirectory'] : null,
            IsBottomReport: isset($data['IsBottomOfTCOReport']) ? (bool) $data['IsBottomOfTCOReport'] : null,
            InDirectory: isset($data['InDirectory']) ? (bool) $data['InDirectory'] : null,
            SellOnWeb: isset($data['SellOnWeb']) ? (bool) $data['SellOnWeb'] : null,
            SendPaperStatement: isset($data['SendPaperStatement']) ? (bool) $data['SendPaperStatement'] : null,
            Active: isset($data['Active']) ? (bool) $data['Active'] : null,
            CreatedBy: $data['CreatedBy'] ?? 'migration',
            ModifiedBy: $data['ModifiedBy'] ?? 'migration',
        );
    }
}