<?php

namespace App\Mapper;

use App\DTO\ClientBankDTO;

class ClientBankMapper
{
    public function map(array $data, int $accountID): ClientBankDTO
    {
        return new ClientBankDTO(
            ClientID: $accountID,
            ExternalReference: 'BankAccount_' . $data['BankAccountID'],
            BSB: $data['BSB'],
            AccountNumber: $data['BankAccountNumber'],
            AccountName: $data['Drawer'],
            AccountType: $data['BankAccountType'],
            ExpiryDate: $data['ExpiryDate'],
            Active: $data['Active']
        );
    }
}