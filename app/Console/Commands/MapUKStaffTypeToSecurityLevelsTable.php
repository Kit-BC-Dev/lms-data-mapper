<?php

namespace App\Console\Commands;

use App\Services\SecurityLevelService;
use App\Services\UKStaffService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-staff-type')]
#[Description('Command description')]
class MapUKStaffTypeToSecurityLevelsTable extends Command
{
    public function __construct(private UKStaffService $uKStaffService, private SecurityLevelService $securityLevelService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UKStaff staff type to SecurityLevels table');

        $staffTypes = $this->uKStaffService->getDistinctStaffType();

        foreach ($staffTypes as $type) {
            $this->securityLevelService->create([
                'SecurityLevel' => $type,
                'Active' => 0,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration'
            ]);
        }

        $this->info("Done! Done! Done! Done!");
    }

}
