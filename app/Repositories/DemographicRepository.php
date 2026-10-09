<?php

namespace App\Repositories;

use App\Models\Demographics\Demographic;

class DemographicRepository
{
    public function __construct(protected Demographic $demographic){}

    public function create(array $data)
    {
        $this->demographic->create($data);
    }

    public function getDemographicByNames(array $demographics)
    {
        return $this->demographic->whereIn('Name', $demographics)->get();
    }
}