<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientExtraDTO
{
    use ArrayableDTO;
    
    public function __construct(
        public ?string $Value,
        public ?string $Name,
        public ?int $ClientID,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}