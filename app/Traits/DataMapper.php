<?php

namespace App\Traits;

trait DataMapper
{
    public function doMapAccount($accounts): array
    {
        return $accounts->mapWithKeys(fn ($parent) => [
            $parent->ExternalAPIRef => array_filter([
                'AccountID' => $parent->ClientID,
                'FirstName' => $parent->FirstName ?? '',
                'ClientAccountStatus' => $parent->status->DisplayName ?? '',
                'ClientAccountType' => $parent->type->Name ?? '',
                'TradeBalance' => $parent->recentBalance->TradeBalance ?? '',
                'CashBalance' => $parent->recentBalance->CashBalance ?? '',

                'CashLoanID' => $parent->loans
                    ->firstWhere('ProductID', 2)?->LoanID,

                'TradeLoanID' => $parent->loans
                    ->firstWhere('ProductID', 1)?->LoanID,
            ], fn ($value) => $value !== null),
        ])->all();
    }

    public function doMapPeople($people): array
    {
        return $people->mapWithKeys(fn ($person) => [
            $person->ExternalAPIRef => [
                'PersonID' => $person->ClientID,
            ],
        ])->all();
    }

    public function doMapCards($cards): array
    {
        return $cards->mapWithKeys(fn ($card) => [
            'Card_' . $card->ExternalReference => [
                'CardID' => $card->CardID,
            ],
        ])->all();
    }

    public function doMapAccountIDs(object $obj): array
    {
        $accountIDs = [];
        foreach ($obj as $data) {
            if (!in_array('Account_' . $data->AccountFK, $accountIDs)) {
                $accountIDs[] = 'Account_' . $data->AccountFK;
            }
        }

        return $accountIDs;
    }
}