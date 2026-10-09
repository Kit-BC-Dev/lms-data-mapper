<?php

namespace App\Mapper;

use App\DTO\SpielDTO;

class SpielMapper
{
    public function map(array $spiel, ?int $outletAccountID): SpielDTO
    {
        return new SpielDTO(
            AccountClientID: $outletAccountID ?? 0,
            ExternalReference: $spiel['SpielID'] ?? 0,
            Content: $spiel['SpielContent'] ?? '',
            DateCreated: $spiel['Created'] ?? null,
            DateModified: $spiel['Modified'] ?? null
        );
    }
}