<?php

namespace App\Console\Commands;

use App\Services\UKAccountStatusService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-acts')]
#[Description('Command description')]
class MapDBUKAccountStatusToClientsTable extends Command
{
    public function __construct(protected UKAccountStatusService $uKAccountStatusService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
         $this->info('Mapping Account Status Data from UK to Clients Table');

        $this->uKAccountStatusService->doMap();

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
