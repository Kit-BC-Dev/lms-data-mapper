<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;


class ClientServiceDTO
{

    use ArrayableDTO;

    public function __construct(
        public ?int $ClientID,
        public ?int $ClientDirectoryCategoryID,
        public ?int $ExternalReference,
        public ?string $ServiceType,
        public ?string $AdditionalProductInformation,
        public ?string $Status,
        public ?int $NumberOfStars,
        public ?int $ContactBroker,
        public ?int $LimitedSupply,
        public ?int $HardcopyDirectory,
        public ?int $WebDirectory,
        public ?string $ContactText,
        public ?string $Active,
        public ?string $DateInactive,
        public ?string $ReasonInactive,
        public ?string $Graphic,
        public ?int $UseOutletPhone,
        public ?int $ListPhone,
        public ?int $ListFax,
        public ?int $ListEmail,
        public ?int $ListWeb,
        public ?int $ListOtherPhone,
        public ?int $UsePostalAddress,
        public ?int $UseStreetAddress,
        public ?int $ListSuburb,
        public ?int $ListState,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}