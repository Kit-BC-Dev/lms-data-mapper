<?php

namespace App\Jobs;

use App\Repositories\UKTransactionFeeRateRepository;
use App\Services\ClientService;
use App\Services\ClientTransactionFeeRateService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Traits\DataMapper;

class MapUKTransactionFeeRateChunkJob implements ShouldQueue
{
    use Queueable, DataMapper;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        UKTransactionFeeRateRepository $uKTransactionFeeRateRepository,
        ClientService $clientService,
        ClientTransactionFeeRateService $clientTransactionFeeRateService

    ): void
    {
        $feeRates = $uKTransactionFeeRateRepository->getChunk($this->ids);

        $accountIds = $this->doMapAccountIDs($feeRates);

        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountIds));

        foreach ($feeRates as $feeRate) {
           $clientTransactionFeeRates[] = [
            'ExternalReference' => 'transaction_fee_rate_' . $feeRate->FeeRateID,
            'ClientID' => $accounts['Account_' . $feeRate->AccountFK]['AccountID'] ?? null,
            'RelatedClientID' => 0,
            'CustomerCashPercentFee' => $feeRate->CustomerCashPercentFee,
            'CustomerTradePercentFee' => $feeRate->CustomerTradePercentFee,
            'MerchantCashPercentFee' => $feeRate->MerchantCashPercentFee,
            'MerchantTradePercentFee' => $feeRate->MerchantTradePercentFee,
            'Active' => $feeRate->DateRemoved ? 0 : 1,
            'CreatedBy' => 'migration',
            'ModifiedBy' => 'migration',
            'DateCreated' => $feeRate->Created,
            'DateModified' => $feeRate->Modified,
           ];
        }
        $clientTransactionFeeRateService->create($clientTransactionFeeRates);
    }
}
