<?php

namespace App\Repositories;

use App\Models\Person\UKPerson;

class UKPersonRepository extends BaseUKRepository
{
    public function __construct(UKPerson $uKPerson)
    {
        parent::__construct(
            $uKPerson,
            'PersonID',
        );
    }
}