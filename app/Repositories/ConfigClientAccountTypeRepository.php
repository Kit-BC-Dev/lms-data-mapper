<?php

namespace App\Repositories;

use App\Models\Config\ConfigClientAccountType;

class ConfigClientAccountTypeRepository
{
    public function __construct(protected ConfigClientAccountType $configClientAccountType)
    {
    }

    public function create(array $data): void
    {
        $this->configClientAccountType->create($data);
    }

    public function getByName(array $names)
    {
        return $this->configClientAccountType->whereIn('Name', $names)->get();
    }
   
}