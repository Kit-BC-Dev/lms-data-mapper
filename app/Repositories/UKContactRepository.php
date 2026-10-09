<?php

namespace App\Repositories;

use App\Models\Contacts\DBUKContact;

class UKContactRepository extends BaseUKRepository
{
    public function __construct(DBUKContact $model)
    {
        parent::__construct(
            $model,
            'ContactID'
        );
    }
}