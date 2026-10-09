<?php

namespace App\Repositories;

use App\Models\Config\ConfigClientAccountStatus;
class ConfigAccountStatusRepository
{
    public function __construct(protected ConfigClientAccountStatus $configAccountStatus){}

    public function create(array $data)
    {
        $this->configAccountStatus->create($data);
    }

    public function getByDisplayName(array $displayNames)
    {
        return $this->configAccountStatus->whereIn('DisplayName', $displayNames)->get();
    }
}