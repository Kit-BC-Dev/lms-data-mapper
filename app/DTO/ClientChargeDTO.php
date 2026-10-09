<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;


class ClientChargeDTO
{

    use ArrayableDTO;

    public function __construct(
        public ?int $ClientID,
        public ?int $ChargeTypeID,
        public ?int $ExternalReference,
        public ?string $Date,
        public ?string $DateEffective,
        public ?float $CashAmount,
        public ?float $TradeAmount,
        public ?int $Reversed,
        public ?int $IsIncome,
        public ?int $Processed,
        public ?int $SystemAdjustment,
        public ?string $Note,
        public ?float $CashBalance,
        public ?float $CashReversed,
        public ?float $WebCharge,
        public ?float $CashTaxValue,
        public ?float $TradeTaxValue,
        public ?float $CashTaxReversed,
        public ?float $CashTaxBalance,
        public ?float $TaxRate,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration',
    ){}
}