<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class DirectoryDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?string $ExternalReference,
        public ?int $AccountClientID,
        public ?int $ClientDirectorySpielID,
        public ?string $Name,
        public ?int $Active,
        public ?string $ReasonInactive,
        public ?int $InternationalListing,
        public ?int $NationalListing,
        public ?int $RegionalListing,
        public ?int $ShowAllOutlets,
        public string $CreatedBy = 'migration',
        public string $ModifiedBy = 'migration',
    ){}
}