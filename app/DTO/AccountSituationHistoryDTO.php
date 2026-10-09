<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class AccountSituationHistoryDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?int $ClientID,
        public ?string $AccountSituation,
        public ?string $Subject,
        public ?string $Type,
        public ?int $ExternalReference,
        public ?string $ContactDate,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}