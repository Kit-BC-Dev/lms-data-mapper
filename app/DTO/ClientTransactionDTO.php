<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientTransactionDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?int $ExternalReference,
        public ?int $TransactionStatusID,
        public ?string $TransactionSource,
        public ?string $AuthorisationStatus,
        public ?int $AuthorisationNumber,
        public ?int $AuthorisationNumberPrefix,
        public ?string $AuthorisationTimestamp,
        public ?int $AuthorisationSource,
        public ?string $AuthorisationCancelledTimestamp,
        public ?int $MerchantClientID,
        public ?int $CustomerClientID,
        public ?int $MerchantCardID,
        public ?int $CustomerCardID,
        public ?string $Date,
        public ?string $DateEffective,
        public ?string $DateProcessed,
        public ?float $CashAmount,
        public ?float $TradeAmount,
        public ?float $TradeAuthorisationAmount,
        public ?float $MerchantCashFees,
        public ?float $CustomerCashFees,
        public ?float $MerchantTradeFees,
        public ?float $CustomerTradeFees,
        public ?string $Notes,
        public ?string $DateCreated,
        public ?string $DateModified,
        public string $CreatedBy = 'migration',
        public string $ModifiedBy = 'migration',
        public ?int $TransactionTypeID = 1
    ){}
}