<?php

namespace App\Services;

use App\Jobs\MapUKStaffChunkJob;
use App\Repositories\UKStaffRepository;

class UKStaffService extends BaseUKService
{
    public function __construct(private UKStaffRepository $uKStaffRepository)
    {
        parent::__construct(
            $uKStaffRepository,
            MapUKStaffChunkJob::class,
            'StaffID',
            1000,
            'user-staff'
        );
    }

    public function getDistinctStaffType()
    {
        return $this->uKStaffRepository->getDistinctStaffType();
    }
}