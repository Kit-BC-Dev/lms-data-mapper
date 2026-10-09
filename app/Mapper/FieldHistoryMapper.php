<?php

namespace App\Mapper;

use App\DTO\FieldHistoryDTO;

class FieldHistoryMapper
{
    public function map(array $data): FieldHistoryDTO
    {
        return new FieldHistoryDTO(
            ExternalReference: $data['ExternalReference'],
            ExternalID: $data['ExternalID'],
            Table: $data['Table'],
            Field: $data['Field'],
            OldValue: $data['OldValue'],
            NewValue: $data['NewValue'],
            DateCreated: $data['DateCreated'],
            DateModified: $data['Modified'] ?? ''
        );
    }
}