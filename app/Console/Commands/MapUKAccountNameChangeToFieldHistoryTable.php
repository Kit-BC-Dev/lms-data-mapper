<?php

namespace App\Console\Commands;

use App\Services\UKAccountNameChangeService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-change')]
#[Description('Map data from UK database table DBUKAccountNameChanges into BMS Field History Table')]
class MapUKAccountNameChangeToFieldHistoryTable extends Command
{
    public function __construct(protected UKAccountNameChangeService $uKAccountNameChangeService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Account Name Changes to Field History table...');

        $this->uKAccountNameChangeService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
