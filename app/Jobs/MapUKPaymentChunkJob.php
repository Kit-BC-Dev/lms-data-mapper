<?php

namespace App\Jobs;

use App\Mapper\LoanPaymentMapper;
use App\Repositories\UKPaymentRepository;
use App\Services\ClientService;
use App\Services\LoanPaymentService;
use App\Traits\DataMapper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapUKPaymentChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;

    /**
     * Create a new job instance.
     */

    private $tradePaymentTypeIDs = [];
    private $paymentStatus = [];
    public function __construct(private array $ids, private int $total)
    {
        $this->tradePaymentTypeIDs = [15, 17, 27];
        $this->paymentStatus = [
            'APP' => 'SUCCESSFUL',
            'PRE' => 'PENDING CONFIRMATION',
            'REV' => 'CHARGEBACK',
            'ADJ' => 'ADJUSTMENT',
            'REF' => 'REFUND',
            'PDC' => 'POST-DATED CHEQUE',
            'ADH' => 'AD HOC',
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKPaymentRepository $uKPaymentRepository,
        ClientService $clientService,
        LoanPaymentMapper $loanPaymentMapper,
        LoanPaymentService $loanPaymentService
    ): void
    {
        $payments = $uKPaymentRepository->getChunk($this->ids);
        $accountIDs = $this->doMapAccountIDs($payments);
        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIDs));

        foreach ($payments as $payment) {
            $account = $accounts['Account_' . $payment->AccountFK];
            $loanID = $account['CashLoanID'] ?? 0;
            
            if (in_array($payment->PaymentTypeFK, $this->tradePaymentTypeIDs)) {
                $loanID = $account['TradeLoanID'] ?? 0;
            }

            $dto = $loanPaymentMapper->map(
                $payment->toArray(),
                $loanID,
                $this->paymentStatus[$payment->FundsStatus] ?? ''
            );

            $loanPayments[] = $dto->toArray();
        }

        $loanPaymentService->create($loanPayments);
        logger()->info([
            'data_mapped_so_far' => $this->total,
            'Table' => 'LoanPayments'
        ]);
    }
}
