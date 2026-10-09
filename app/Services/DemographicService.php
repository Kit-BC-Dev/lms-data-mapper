<?php

namespace App\Services;

use App\Repositories\DemographicRepository;

class DemographicService
{
    public function __construct(protected DemographicRepository $demographicRepository){}

    public function create(array $data)
    {
        $this->demographicRepository->create($data);
    }

    public function getDemographicByNames(array $demographics)
    {
        return $this->demographicRepository->getDemographicByNames($demographics);
    }
}