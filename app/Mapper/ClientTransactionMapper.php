<?php

namespace App\Mapper;

use App\DTO\ClientTransactionDTO;

class ClientTransactionMapper
{
    public function map(array $data, array $accounts, array $cards, int $statusID): ClientTransactionDTO
    {
        return new ClientTransactionDTO(
            ExternalReference: $data['TransactionID'],
            TransactionStatusID: $statusID,
            TransactionSource: $data['TransactionSource'],
            AuthorisationStatus: $data['AuthorisationStatus'],
            AuthorisationNumber: $data['AuthorisationNumber'],
            AuthorisationNumberPrefix: $data['AuthNoPrefix'],
            AuthorisationTimestamp: $data['AuthorisationTimestamp'],
            AuthorisationSource: $data['AuthorisationSource'],
            AuthorisationCancelledTimestamp: $data['AuthorisationTimestamp'],
            MerchantClientID: $accounts['Account_' . $data['MerchantAccountFK']]['AccountID'] ?? 0,
            CustomerClientID: $accounts['Account_' . $data['CustomerAccountFK']]['AccountID'] ?? 0,
            MerchantCardID: $cards['Card_' . $data['MerchantCardFK']]['CardID'] ?? 0,
            CustomerCardID: $cards['Card_' . $data['CustomerCardFK']]['CardID'] ?? 0,
            Date: $data['TransactionDate'],
            DateEffective: $data['TransactionDate'],
            DateProcessed: $data['TransactionProcessDate'],
            CashAmount: $data['CashValue'],
            TradeAmount: $data['TransactionValue'],
            TradeAuthorisationAmount: $data['AuthorisationValue'],
            MerchantCashFees: $data['MerchantCashFee'],
            CustomerCashFees: $data['CustomerCashFee'],
            MerchantTradeFees: $data['MerchantTradeFee'],
            CustomerTradeFees: $data['CustomerTradeFee'],
            Notes: $data['note']['Notes'] ?? '',
            DateCreated: $data['Created'],
            DateModified: $data['Modified']
        );
    }
}