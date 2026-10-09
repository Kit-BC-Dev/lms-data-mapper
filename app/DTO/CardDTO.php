<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class CardDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?string $ExternalReference,
        public ?string $AccountClientExternalReference,
        public ?int $AccountClientID,
        public ?string $HolderClientExternalReference,
        public ?int $HolderClientID,
        public ?int $CardTypeID,
        public ?int $CardStatusID,
        public ?string $CardNumber,
        public ?int $CardIndex,
        public ?string $CardLine1,
        public ?string $CardLine2,
        public ?int $BuyEnabled,
        public ?string $IssueDate,
        public ?string $ExpiryDate,
        public ?string $CancelDate,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration',
    ) {
    }
}