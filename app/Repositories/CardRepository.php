<?php

namespace App\Repositories;

use App\Models\Cards\Card;

class CardRepository
{
    public function __construct(protected Card $card){}

    public function updateOrCreate(array $data): void
    {
        $this->card->upsert(
            $data,
            [
                'ExternalReference'
            ]
        );
    }

    public function getByExternalReference(array $references)
    {
        return $this->card->select('CardID', 'ExternalReference')->whereIn('ExternalReference', $references)->get();
    }

    public function getByCardNumber(array $cardNumbers)
    {
        return $this->card->select('CardNumber', 'AccountClientID')->with('accountClient')->whereIn('CardNumber', $cardNumbers)->get();
    }
}