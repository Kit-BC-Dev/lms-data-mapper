<?php

namespace App\Console\Commands;

use App\Services\UKContactService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Services\UKAccountService;

#[Signature('app:map-actsh')]
#[Description('Command description')]
class MapUKContactsToAccountSituationHistoryTable extends Command
{
    public function __construct(
        protected UKContactService $uKContactService
    )
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Contact to Account Situation History table...');

        $this->uKContactService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
