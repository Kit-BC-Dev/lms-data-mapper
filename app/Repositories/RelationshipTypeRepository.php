<?php

namespace App\Repositories;

use App\Models\ClientRelationship\RelationshipTypes;

class RelationshipTypeRepository
{
    public function __construct(protected RelationshipTypes $relationshipTypes){}

    public function getByName(string $name)
    {
        return $this->relationshipTypes->where("Name", $name)->first();
    }
}