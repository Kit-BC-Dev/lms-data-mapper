<?php

namespace App\Console\Commands;

use App\Services\UKBankAccountService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-bank-accounts')]
#[Description('Command description')]
class MapUKBankAccountToClientBanksTable extends Command
{
    public function __construct(protected UKBankAccountService $ukBankAccountService){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Bank Accounts to Client Banks table...');
        $this->ukBankAccountService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
