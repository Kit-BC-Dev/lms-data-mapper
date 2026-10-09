<?php

namespace App\Mapper;

use App\DTO\CardDTO;

class CardMapper
{
    public function map(array $card, $accountID, $personID): CardDTO
    {
        return new CardDTO(
            ExternalReference: $card['CardID'],
            AccountClientExternalReference: $card['AccountFK'],
            AccountClientID: $accountID,
            HolderClientExternalReference: $card['PersonFK'],
            HolderClientID: $personID,
            CardTypeID: $card['CardType'],
            CardStatusID: $card['status']['CardStatusID'],
            CardNumber: $card['CardNumber'],
            CardIndex: $card['CardNo'],
            CardLine1: $card['CardLine1'],
            CardLine2: $card['CardLine2'],
            BuyEnabled: $card['BuyEnabled'],
            IssueDate: $card['OrderDate'] ?: null,
            ExpiryDate: $card['ExpiryDate'] ?: null,
            CancelDate: $card['CancelDate'] ?: null,
            DateCreated: $card['Created'] ?: null,
            DateModified: $card['Modified'] ?: null
        );
    }
}