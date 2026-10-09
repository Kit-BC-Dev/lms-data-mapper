<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;


class AccountDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?string $ExternalAPIRef,
        public ?string $FirstName,
        public ?int $PrimaryAddressID,
        public ?string $AccountNumber,
        public ?int $ClientTypeID,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy,
        public ?string $ModifiedBy
    ) {
    }
}