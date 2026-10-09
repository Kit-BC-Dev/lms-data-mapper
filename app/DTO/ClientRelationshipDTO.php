<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientRelationshipDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?int $RelationshipTypeID,
        public ?int $ClientID,
        public ?int $RelatedClientID,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}