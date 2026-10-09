<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class AddressDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?int $ClientID,
        public ?int $ExternalReference,
        public ?string $AddressName,
        public ?string $UnitNumber,
        public ?string $StreetNumber,
        public ?string $Address,
        public ?string $Suburb,
        public ?string $City,
        public ?string $State,
        public ?string $PostCode,
        public ?string $Country,
        public ?string $CreatedBy = 'migration',
    ) {
    }
}