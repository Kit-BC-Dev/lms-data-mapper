<?php

namespace App\Console\Commands;

use App\Services\ConfigClientAccountTypeService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-actt')]
#[Description('Command description')]
class MapUKAccountTypeToConfigClientAccountTypesTable extends Command
{

    public function __construct(
        protected ConfigClientAccountTypeService $configClientAccountTypeService
    )
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping Config Client Account Types Data from UK to Account Types Table');

        $this->configClientAccountTypeService->create();

        $this->info('Mapping jobs dispatched successfully.');

        return self::SUCCESS;
    }
}
