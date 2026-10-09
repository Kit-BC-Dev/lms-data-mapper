<?php

namespace App\Console\Commands;

use App\Services\UKAccountStgageService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-stage')]
#[Description('Command description')]
class MapUKAccountStageToClientExtrasTable extends Command
{
    public function __construct(
        protected UKAccountStgageService $uKAccountStgageService
    ) {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Account Stage Change to Client Extras table...');

        $this->uKAccountStgageService->doMap();

        
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
