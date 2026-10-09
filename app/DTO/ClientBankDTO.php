<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientBankDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?int $ClientID,
        public ?string $ExternalReference,
        public ?string $BSB,
        public ?string $AccountNumber,
        public ?string $AccountName,
        public ?string $AccountType,
        public ?string $ExpiryDate,
        public ?int $Active,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}