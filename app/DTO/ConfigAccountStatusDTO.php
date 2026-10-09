<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ConfigAccountStatusDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?string $Name,
        public ?string $DisplayName,
        public ?string $Description,
        public ?int $BuyEnabled,
        public ?int $SellEnabled,
        public ?int $InDirectory,
        public ?int $Active,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModeifiedBy = 'migration'

    ){}
}