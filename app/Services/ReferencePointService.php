<?php

namespace App\Services;

use App\DTO\ReferencePointDTO;
use App\Repositories\ReferencePointRepository;

class ReferencePointService
{
    public function __construct(protected ReferencePointRepository $referencePointRepository){}

    public function create(array $referencePoints)
    {
        $this->referencePointRepository->updateOrCreate($referencePoints);
    }
}