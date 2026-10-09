<?php

namespace App\Repositories;

use App\Models\users\SecurityLevel;

class SeucrityLevelRepository
{
    public function __construct(private SecurityLevel $securityLevel){}

    public function create(array $data)
    {
        return $this->securityLevel->create($data);
    }

    public function getBySecurityLevel(array $securityLevels)
    {
        return $this->securityLevel->whereIn('SecurityLevel', $securityLevels)->get();
    }
    
}