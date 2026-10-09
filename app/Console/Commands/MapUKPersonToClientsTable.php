<?php

namespace App\Console\Commands;

use App\Services\UKPersonService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-person')]
#[Description('Command description')]
class MapUKPersonToClientsTable extends Command
{
    public function __construct(private UKPersonService $uKPersonService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Persons to Clients table...');

        $this->uKPersonService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
