<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ConfigClientAccountTypeDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?string $Name,
        public ?string $Description,
        public ?bool $IsStaff,
        public ?bool $SendDirectory,
        public ?bool $IsBottomReport,
        public ?bool $InDirectory,
        public ?bool $SellOnWeb,
        public ?bool $SendPaperStatement,
        public ?bool $Active,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}