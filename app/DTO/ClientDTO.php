<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?int $ParentClientID,
        public ?string $ExternalAPIRef,
        public ?int $ClientTypeID,
        public ?int $PrimaryAddressID,
        public ?string $FirstName,
        public ?string $MobileNumber,
        public ?string $WorkPhoneNumber,
        public ?string $EmailAddress,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration',
         public ?int $TimeZoneID = 0,

    ){}

    
}