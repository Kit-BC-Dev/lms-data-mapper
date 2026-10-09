<?php

namespace App\Console\Commands;

use App\Services\CardService;
use App\Services\ClientService;
use App\Services\ClientTransactionScheduleService;
use App\Services\UKScheduledTransactionService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Traits\DataMapper;
#[Signature('app:map-stcts')]
#[Description('Command description')]
class MapUKScheduledTransactionsToClientTransactionSchedulesTable extends Command
{
    use DataMapper;

    public function __construct(
        protected UKScheduledTransactionService $uKScheduledTransactionService,
        protected ClientTransactionScheduleService $clientTransactionScheduleService,
        protected ClientService $clientService,
        protected CardService $cardService,
    ) {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Schedules Transactions to Client Transaction Schedules table...');

        $scheduledTransactions = $this->uKScheduledTransactionService->get();
        $accountIDs = [];
        $cardIDs = [];

        foreach ($scheduledTransactions as $scheduledTransaction) {
            if (!in_array('Account_' . $scheduledTransaction->CustomerAccountFK, $accountIDs)) {
                $accountIDs[] = 'Account_' . $scheduledTransaction->CustomerAccountFK;
            }

            if (!in_array('Account_' . $scheduledTransaction->MerchantAccountFK, $accountIDs)) {
                $accountIDs[] = 'Account_' . $scheduledTransaction->MerchantAccountFK;
            }

            if (!in_array($scheduledTransaction->CustomerCardFK, $cardIDs)) {
                $cardIDs[] = $scheduledTransaction->CustomerCardFK;
            }
        }

        $accounts = $this->doMapAccount($this->clientService->getByExternalApiRefs($accountIDs));
        $cards = $this->doMapCards($this->cardService->getByExternalReference($cardIDs));

        foreach ($scheduledTransactions as $st) {
            $clientTransactionSchedules[] = [
                'ExternalReference' => $st->ADATransactionID,
                'MerchantClientID' => $accounts['Account_' . $st->MerchantAccountFK]['AccountID'] ?? 0,
                'CustomerClientID' => $accounts['Account_' . $st->CustomerAccountFK]['AccountID'] ?? 0,
                'CustomerCardID' => $cards['Card_' . $st->CustomerCardFK]['CardID'] ?? 0,
                'Frequency' => $st->Frequency,
                'Amount' => $st->Amount,
                'AdjustmentAmount' => $st->Adjustment,
                'AdjustmentDate' => $st->AdjustmentDate,
                'AdjustmentFirst' => $st->FirstAmount,
                'AdjustmentLast' => $st->LastAmount,
                'AgreementDate' => $st->AgreementDate,
                'TerminationDate' => $st->TerminationDate,
                'StartDate' => $st->FromDate,
                'EndDate' => $st->ToDate,
                'LastTransactionDate' => $st->LastTransactionDate,
                'NextTransactionDate' => $st->NextTransactionDate,
                'Notes' => $st->Notes,
                'DateCreated' => $st->Created,
                'DateModified' => $st->Modified,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration'
            ];
        }

        $this->clientTransactionScheduleService->create($clientTransactionSchedules);

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
