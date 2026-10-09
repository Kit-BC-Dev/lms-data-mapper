<?php

namespace App\Console\Commands;

use App\Services\UKPaymentService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-account-payments')]
#[Description('Command description')]
class MapUKPaymentToLoanPaymentsTable extends Command
{
    public function __construct(private UKPaymentService $uKPaymentService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Payments to Loan Payments table...');

        $this->uKPaymentService->doMap();
        
        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
