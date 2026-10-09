<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;
class ClientBalanceDTO
{
    use ArrayableDTO;
    public function __construct(
        public ?int $ClientID,
        public ?int $ExternalReference,
        public ?float $CashBalance,
        public ?float $TradeBalance,
        public ?float $NonApportionedValue,
        public ?string $Date,
        public ?float $OutstandingPurchases,
        public ?float $OutstandingSales,
        public ?float $PeriodSales,
        public ?float $PeriodPurchases,
        public ?float $TaxCashBalance,
        public ?float $TaxTradeBalance,
        public ?int $PeriodNumberSales,
        public ?int $PeriodNumberPurchases,
        public ?int $NumberOutstandingSales,
        public ?int $NumberOutstandingPurchases,
        public ?float $TradeTradingFees,
        public ?float $CashTradingFees,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}