<?php

namespace App\Repositories;

use App\Models\Staffs\UKStaff;

class UKStaffRepository extends BaseUKRepository
{
    public function __construct(private UKStaff $uKStaff)
    {
        parent::__construct($uKStaff, 'StaffID');
    }

    public function getDistinctStaffType()
    {
        return $this->uKStaff
            ->select('StaffType')
            ->distinct()
            ->whereNotNull('StaffType')
            ->where("StaffType", '!=', "")
            ->pluck('StaffType');
    }
}