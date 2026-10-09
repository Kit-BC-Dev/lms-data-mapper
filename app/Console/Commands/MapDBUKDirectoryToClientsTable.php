<?php

namespace App\Console\Commands;

use App\Services\UKDirectoryService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-dtc')]
#[Description('Command description')]
class MapDBUKDirectoryToClientsTable extends Command
{
    public function __construct(private UKDirectoryService $uKDirectoryService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Mapping Directory Data from UK to Clients Table');

        $this->uKDirectoryService->doMap();

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
