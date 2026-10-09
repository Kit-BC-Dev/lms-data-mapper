<?php

namespace App\Mapper;

use App\DTO\ClientBalanceDTO;

class ClientBalanceMapper
{
    public function map(array $data, int $accountID): ClientBalanceDTO
    {
        return new ClientBalanceDTO(
            ClientID: $accountID,
            ExternalReference: $data['AccountFK'],
            CashBalance: $data['CurrentCashBalance'],
            TradeBalance: $data['CurrentTradeBalance'],
            NonApportionedValue: $data['NonApportionedValue'],
            OutstandingPurchases: $data['OutstandingPurchases'],
            OutstandingSales: $data['OutstandingSales'],
            PeriodSales: $data['PeriodSales'],
            Date: $data['Modified'],
            PeriodPurchases: $data['PeriodPurchases'],
            TaxCashBalance: $data['TaxCashBalance'],
            TaxTradeBalance: $data['TaxTradeBalance'],
            PeriodNumberSales: $data['PeriodNumberSales'],
            PeriodNumberPurchases: $data['PeriodNumberPurchases'],
            NumberOutstandingSales: $data['NumberOutstandingSales'],
            NumberOutstandingPurchases: $data['NumberOutstandingPurchases'],
            TradeTradingFees: $data['TradeTradingFees'],
            CashTradingFees: $data['CashTradingFees'],
            DateCreated: $data['Created'] ?? '',
            DateModified: $data['Modified'],
        );
    }
}