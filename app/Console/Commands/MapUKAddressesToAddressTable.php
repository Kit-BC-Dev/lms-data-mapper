<?php

namespace App\Console\Commands;

use App\Services\UKAddressService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-address')]
#[Description('Command description')]
class MapUKAddressesToAddressTable extends Command
{
    public function __construct(private UKAddressService $ukAddressService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Address changes to Address table...');
        $this->ukAddressService->doMap();
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
