<?php

namespace App\Mapper;

use App\DTO\AccountSituationHistoryDTO;

class AccountSituationHistoryMapper
{
    public function map(array $data, int $clientID): AccountSituationHistoryDTO
    {
        return new AccountSituationHistoryDTO(
            ClientID: $clientID,
            ExternalReference: $data['ContactID'],
            AccountSituation: $data['ContactDetails'],
            Subject: $data['Subject'],
            Type: $data['Method'],
            ContactDate: $data['ContactDate'],
            DateCreated: $data['Created'],
            DateModified: $data['Modified']
        );
    }
}