<?php

namespace App\Mapper;

use App\DTO\ClientChargeDTO;

class ClientChargeMapper
{
    public function map(array $data, int $clientID, int $chargeTypeID): ClientChargeDTO
    {
        return new ClientChargeDTO(
            ClientID: $clientID,
            ChargeTypeID: $chargeTypeID,
            ExternalReference: $data['ChargeID'],
            Date: $data['DateEffective'],
            DateEffective: $data['DateEffective'],
            CashAmount: $data['CashValue'],
            TradeAmount: $data['TradeValue'],
            Reversed: $data['Reversed'],
            IsIncome: $data['IsIncome'],
            Processed: $data['Processed'],
            SystemAdjustment: $data['SystemAdjustment'],
            Note: $data['Note'],
            CashBalance: $data['CashBalance'],
            CashReversed: $data['CashReversed'],
            WebCharge: $data['WebCharge'],
            CashTaxValue: $data['CashTaxValue'],
            TradeTaxValue: $data['TradeTaxValue'],
            CashTaxReversed: $data['CashTaxReversed'],
            CashTaxBalance: $data['CashTaxBalance'],
            TaxRate: $data['TaxRate'],
            DateCreated: $data['Created'],
            DateModified: $data['Modified']
        );
    }
}