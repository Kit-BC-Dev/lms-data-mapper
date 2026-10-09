<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Services\UKCardService;

#[Signature('app:map-cards')]
#[Description('Command description')]
class MapUKCardsToCardsTable extends Command
{

    public function __construct(private UKCardService $uKCardService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Cards to Cards table...');
        $this->uKCardService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;

    }
}
