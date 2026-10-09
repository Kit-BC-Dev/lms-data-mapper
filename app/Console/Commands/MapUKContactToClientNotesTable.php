<?php

namespace App\Console\Commands;

use App\Services\UKContactService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-ctcn')]
#[Description('Command description')]
class MapUKContactToClientNotesTable extends Command
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
        $this->info('Mapping UK Contact to Client Notes table...');

        $this->uKContactService->doMap('Client Notes');

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
