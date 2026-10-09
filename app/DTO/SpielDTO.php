<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class SpielDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?int $AccountClientID,
        public ?int $ExternalReference,
        public ?string $Content,
        public ?string $CreatedBy = 'migration',
        public ?string $DateCreated = null,
        public ?string $DateModified = null,
        public ?string $ModifiedBy = 'migration',
    ){}
}