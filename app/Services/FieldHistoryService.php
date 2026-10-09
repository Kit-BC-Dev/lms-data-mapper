<?php

namespace App\Services;

use App\Repositories\FieldHistoryRepository;

class FieldHistoryService
{
    public function __construct(protected FieldHistoryRepository $fieldHistoryRepository){}

    public function create(array $data)
    {
        $this->fieldHistoryRepository->updateOrCreate($data);
    }
}