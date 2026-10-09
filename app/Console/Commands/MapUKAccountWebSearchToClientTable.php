<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Services\UKAccountService;

#[Signature('app:map-dmtc')]
#[Description('Command description')]
class MapUKAccountWebSearchToClientTable extends Command
{
    public function __construct(protected UKAccountService $uKAccountService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Account Web Search Demographic to Clients table...');
        $this->uKAccountService->doMap('Demographic');

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
