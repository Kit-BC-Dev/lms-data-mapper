<?php

namespace App\Jobs;

use App\Repositories\UKStaffRepository;
use App\Services\SecurityLevelService;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapUKStaffChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKStaffRepository $uKStaffRepository,
        SecurityLevelService $securityLevelService,
        UserService $userService
    ): void
    {
        $staffs = $uKStaffRepository->getChunk($this->ids);

        $staffTypes = [];
        foreach ($staffs as $staff) {
            if (!in_array($staff->StaffType, $staffTypes) && $staff->StaffType != "") {
                $staffTypes[] = $staff->StaffType;
            }
        }

        $securitLevels = $securityLevelService->getBySecurityLevel($staffTypes)->mapWithKeys(fn ($security) => [
            $security->SecurityLevel => [
                'SecurityLevelID' => $security->SecurityLevelID,
            ],
        ])->all();;


        foreach ($staffs as $staff) {
            $users[] = [
                'SecurityLevelID' => $staff->StaffType == "" ? 0 : $securitLevels[$staff->StaffType]['SecurityLevelID'],
                'FirstName' => $staff->ShortName,
                'ExternalReference' => 'Staff_' . $staff->StaffID,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration',
                'Active' => 0
            ];
        }

        $userService->create($users);
    }
}
