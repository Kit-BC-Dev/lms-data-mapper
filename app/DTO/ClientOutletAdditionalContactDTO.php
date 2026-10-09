<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientOutletAdditionalContactDTO
{

    use ArrayableDTO;
    public function __construct(
        public ?int $ClientID,
        public ?string $Title,
        public ?string $FirstName,
        public ?string $LastName,
        public ?string $Email,
        public ?string $BusinessName,
        public ?string $Role,
        public ?string $BusinessPhone,
        public ?string $HomePhone,
        public ?string $Mobile,
        public ?string $Fax,
    ) {}
}