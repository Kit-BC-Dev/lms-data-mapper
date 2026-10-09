<?php

namespace App\Console\Commands;

use App\Services\UKAccountTypeChangeService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-type-change')]
#[Description('Map data from UK database table DBUKAccountTypeChanges into BMS Field History Table')]
class MapUKAccountTypeChangesToFieldHistoryTable extends Command
{
    public function __construct(
        protected UKAccountTypeChangeService $uKAccountTypeChangeService
    ) {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping Config Client Account Types Data from UK to Account Types Table');

        $this->uKAccountTypeChangeService->doMap();

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
