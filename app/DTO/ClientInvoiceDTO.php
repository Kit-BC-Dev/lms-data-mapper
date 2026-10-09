<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientInvoiceDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?string $ExternalReference,
        public ?int $ClientID,
        public ?int $InvoiceSeriesID,
        public ?string $AccountStatus,
        public ?bool $ETrade,
        public ?float $ExchangeRate,
        public ?float $OpeningCashBalance,
        public ?float $OpeningTradeBalance,
        public ?float $CashFeesThisPeriod,
        public ?float $TradeFeesThisPeriod,
        public ?float $CashChargesThisPeriod,
        public ?float $TradeChargesThisPeriod,
        public ?float $CashPaymentsThisPeriod,
        public ?float $TotalPaymentsThisPeriod,
        public ?float $ClosingCashBalance,
        public ?float $ClosingTradeBalance,
        public ?float $OpeningCashFees,
        public ?float $OpeningCashCharges,
        public ?float $ClosingCashFees,
        public ?float $ClosingCashCharges,
        public ?float $YTDSales,
        public ?float $YTDPurchases,
        public ?int $YTDNumberSales,
        public ?int $YTDNumberPurchases,
        public ?float $SeriesSales,
        public ?float $SeriesPurchases,
        public ?int $SeriesNumberSales,
        public ?int $SeriesNumberPurchases,
        public ?float $ClosingCreditLimit,
        public ?float $CashTaxThisPeriod,
        public ?float $TradeTaxThisPeriod,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}