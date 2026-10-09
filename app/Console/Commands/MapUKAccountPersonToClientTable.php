<?php

namespace App\Console\Commands;

use App\Services\UKAccountService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-client-parent')]
#[Description('Command description')]
class MapUKAccountPersonToClientTable extends Command
{
    public function __construct(private UKAccountService $uKAccountService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Map Persons to Client Parent');

        $this->uKAccountService->doMap('Parent');
    }
}
