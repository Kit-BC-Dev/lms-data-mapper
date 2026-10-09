<?php

namespace App\Console\Commands;

use App\Services\UKAccountService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-accounts')]
#[Description('Command description')]
class MapUKAccountsToClientsTable extends Command
{
    public function __construct(private UKAccountService $ukAccountService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
         $this->info('Mapping Accounts Data from UK to Clients Table');

        $this->ukAccountService->doMap('Accounts');

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
