<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class FieldHistoryDTO
{

    use ArrayableDTO;
    public function __construct(
        public ?string $ExternalReference,
        public ?int $ExternalID,
        public ?string $Table,
        public ?string $Field,
        public ?string $OldValue,
        public ?string $NewValue,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}