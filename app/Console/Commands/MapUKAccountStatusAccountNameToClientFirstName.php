<?php

namespace App\Console\Commands;

use App\Services\UKAccountStatusAccountNameService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-name')]
#[Description('Command description')]
class MapUKAccountStatusAccountNameToClientFirstName extends Command
{
    public function __construct(
        protected UKAccountStatusAccountNameService $uKAccountStatusAccountNameService
    ){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Account Status AccountName field to Client First Name Field...');

        $this->uKAccountStatusAccountNameService->doMap();

        
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
