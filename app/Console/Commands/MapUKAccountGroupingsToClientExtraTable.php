<?php

namespace App\Console\Commands;

use App\Services\UKAccountService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-groupings')]
#[Description('Command description')]
class MapUKAccountGroupingsToClientExtraTable extends Command
{
    public function __construct(
        private UKAccountService $uKAccountService
    ){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping Account Grouping Data from UK to Client Extras Table');

        $this->uKAccountService->doMap();

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
