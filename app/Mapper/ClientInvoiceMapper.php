<?php

namespace App\Mapper;

use App\DTO\ClientInvoiceDTO;

class ClientInvoiceMapper
{
    public function map(array $data, $accountID, $invoiceSeriesID): ClientInvoiceDTO
    {
        return new ClientInvoiceDTO(
            ExternalReference: 'ClientInvoice_' . ($data['InvoiceID'] ?? ''),
            InvoiceSeriesID: $invoiceSeriesID ?? null,
            AccountStatus: $data['AccountStatus'] ?? null,
            ClientID: $accountID ?? null,
            ETrade: $data['ETrade'] ?? null,
            ExchangeRate: $data['ExchangeRate'] ?? null,
            OpeningCashBalance: $data['OpeningCashBalance'] ?? null,
            OpeningTradeBalance: $data['OpeningTradeBalance'] ?? null,
            CashFeesThisPeriod: $data['CashFeesThisPeriod'] ?? null,
            TradeFeesThisPeriod: $data['TradeFeesThisPeriod'] ?? null,
            CashChargesThisPeriod: $data['CashChargesThisPeriod'] ?? null,
            TradeChargesThisPeriod: $data['TradeChargesThisPeriod'] ?? null,
            CashPaymentsThisPeriod: $data['CashPaymentsThisPeriod'] ?? null,
            TotalPaymentsThisPeriod: $data['TotalPaymentsThisPeriod'] ?? null,
            ClosingCashBalance: $data['ClosingCashBalance'] ?? null,
            ClosingTradeBalance: $data['ClosingTradeBalance'] ?? null,
            OpeningCashFees: $data['OpeningCashFees'] ?? null,
            OpeningCashCharges: $data['OpeningCashCharges'] ?? null,
            ClosingCashFees: $data['ClosingCashFees'] ?? null,
            ClosingCashCharges: $data['ClosingCashCharges'] ?? null,
            YTDSales: $data['YTDSales'] ?? null,
            YTDPurchases: $data['YTDPurchases'] ?? null,
            YTDNumberSales: $data['YTDNumberSales'] ?? null,
            YTDNumberPurchases: $data['YTDNumberPurchases'] ?? null,
            SeriesSales: $data['SeriesSales'] ?? null,
            SeriesPurchases: $data['SeriesPurchases'] ?? null,
            SeriesNumberSales: $data['SeriesNumberSales'] ?? null,
            SeriesNumberPurchases: $data['SeriesNumberPurchases'] ?? null,
            ClosingCreditLimit: $data['ClosingCreditLimit'] ?? null,
            CashTaxThisPeriod: $data['CashTaxThisPeriod'] ?? null,
            TradeTaxThisPeriod: $data['TradeTaxThisPeriod'] ?? null,
            DateCreated: $data['Created'] ?? null,
            DateModified: $data['Modified'] ?? null,
        );
    }
}