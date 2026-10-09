<?php

namespace App\Console\Commands;

use App\Services\UKAccountService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-actd')]
#[Description('Command description')]
class MapUKAccountDetailsToClientExtraTable extends Command
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
        $this->info('Mapping Account Status Data from UK to Clients Table');

        $this->uKAccountService->doMap('AccountDetails');

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
