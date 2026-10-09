<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ReferencePointDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?int $ClientDirectoryID,
        public ?int $AccountClientID,
        public ?int $OutletClientID,
        public $ReferencePoint = null,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}