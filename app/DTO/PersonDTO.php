<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class PersonDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?string $ExternalAPIRef,
        public ?int $ClientTypeID,
        public ?int $PrimaryAddressID,
        public ?string $FirstName,
        public ?string $LastName,
        public ?string $MiddleName,
        public ?string $Title,
        public ?string $EmailAddress,
        public ?string $WorkPhoneNumber,
        public ?string $MobileNumber,
        public ?string $HomePhoneNumber,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy,
        public ?string $ModifiedBy
    ) {
    }
}