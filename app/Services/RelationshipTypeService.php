<?php

namespace App\Services;

use App\Repositories\RelationshipTypeRepository;

class RelationshipTypeService
{
    public function __construct(protected RelationshipTypeRepository $relationshipTypeRepository){}

    public function getByName(string $name)
    {
        return $this->relationshipTypeRepository->getByName($name);
    }
}