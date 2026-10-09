<?php

namespace App\Console\Commands;

use App\Services\UKStaffService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-staff')]
#[Description('Command description')]
class MapUKStaffToUsersTable extends Command
{
    public function __construct(private UKStaffService $uKStaffService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Mapping Staff to Users table");

        $this->uKStaffService->doMap();

        $this->info("DONE! DONE! DONE! DONE!");

    }
}
