<?php

namespace App\Console\Commands;

use App\Services\ClientService;
use App\Services\LoanService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
#[Signature('app:create-loan')]
#[Description('Command description')]
class CreateLoansForMappedClient extends Command
{
    public function __construct(private LoanService $loanService, private ClientService $clientService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating Loans for newly mapped Accounts');

        $accounts = $this->clientService->getClientAccountsWithLoans();
        $nextMonth = now()->addMonth()->startOfMonth();
        foreach ($accounts as $account) {
            if (count($account->loans) == 0) {
                $clientLoans[] = [
                    'ClientID' => $account->ClientID,
                    'AddressID' => $account->PrimartyAddressID ?? 0,
                    'ProductID' => 2,
                    'LoanType' => 'EFT',
                    'ExternalReference' => 'Loan_' . Str::uuid(),
                    'RepaymentFrequency' => 'Monthly',
                    'RepaymentNextDate' => $nextMonth,
                    'RepaymentStartDate' => $nextMonth,
                    'LoanStartDate' => now(),
                    'LoanApproval' => 'Approved',
                    'LoanStatusID' => 2,
                    'CreatedBy' => 'migration',
                    'ModifiedBy' => 'migration'
                ];
                $clientLoans[] = [
                    'ClientID' => $account->ClientID,
                    'AddressID' => $account->PrimartyAddressID ?? 0,
                    'ProductID' => 1,
                    'LoanType' => 'EFT',
                    'ExternalReference' => 'Loan_' .  Str::uuid(),
                    'RepaymentFrequency' => 'Monthly',
                    'RepaymentNextDate' => $nextMonth,
                    'RepaymentStartDate' => $nextMonth,
                    'LoanStartDate' => now(),
                    'LoanApproval' => 'Approved',
                    'LoanStatusID' => 2,
                    'CreatedBy' => 'migration',
                    'ModifiedBy' => 'migration'
                ];
            }
        }

        $this->loanService->create($clientLoans);

        $this->info('Created loans successfully.');

        return self::SUCCESS;
    }
}
