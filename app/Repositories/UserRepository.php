<?php

namespace App\Repositories;

use App\Models\Staffs\User;

class UserRepository
{
    public function __construct(private User $user){}

    public function create(array $data)
    {
         $this->user->upsert(
            $data,
            ['ExternalAPIRef']
        );
    }

    public function getUserByExternalReference(array $externalReferences)
    {
        return $this->user->whereIn('ExternalReference', $externalReferences)->get();
    }
}