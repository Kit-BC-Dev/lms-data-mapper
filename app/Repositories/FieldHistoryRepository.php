<?php

namespace App\Repositories;

use App\Models\History\FieldHistory;

class FieldHistoryRepository
{
    public function __construct(protected FieldHistory $fieldHistory){}

    public function updateOrCreate(array $data)
    {
        $this->fieldHistory->upsert(
            $data,
            ['ExternalReference']
        );
    }
}