<?php

namespace App\Services;

use App\Repositories\SpielRepository;

class SpielService
{
    public function __construct(protected SpielRepository $spielRepository){}

    public function create(array $spiels)
    {
        $this->spielRepository->updateOrCreate($spiels);
    }

    public function getSpielsFromReference(array $externalReferenceIDs)
    {
        return $this->spielRepository->getSpielsFromReference($externalReferenceIDs);
    }
}