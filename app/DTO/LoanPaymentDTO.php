<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class LoanPaymentDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?int $LoanID,
        public ?string $Date,
        public ?string $DateSuccessful,
        public ?string $PaymentType,
        public ?string $PaymentStatus,
        public ?float $Amount,
        public ?string $Comment,
        public ?string $ExternalAPIRef,
        public ?string $DateCreated,
        public ?string $DateModified,
        public string $CreatedBy = 'migration',
        public string $ModifiedBy = 'migration',
    ){}
}
