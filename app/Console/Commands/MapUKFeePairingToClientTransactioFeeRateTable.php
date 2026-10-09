<?php

namespace App\Console\Commands;

use App\Services\ClientTransactionFeeRateService;
use App\Services\UKFeePairingService;
use App\Services\ClientService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Traits\DataMapper;

#[Signature('app:map-ctfr')]
#[Description('Command description')]
class MapUKFeePairingToClientTransactioFeeRateTable extends Command
{
    use DataMapper;
    public function __construct(
        protected ClientTransactionFeeRateService $clientTransactionFeeRateService,
        protected UKFeePairingService $uKFeePairingService,
        protected ClientService $clientService
    ){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Fee Pairing to Client Transaction Fee Rate table...');
        
        $fees = $this->uKFeePairingService->get();

        $merchantIDs = [];
        $customerIDs = [];

        foreach ($fees as $fee) {
            if (!in_array('Account_' . $fee->MerchantAccountFK, $merchantIDs)) {
                $merchantIDs[] = 'Account_' . $fee->MerchantAccountFK;
            }

            if (!in_array('Account_' . $fee->CustomerAccountFK, $customerIDs)) {
                $customerIDs[] = 'Account_' . $fee->CustomerAccountFK;
            }
        }
        
        $merchants = $this->doMapAccount($this->clientService->getByExternalApiRefs($merchantIDs));
        $customers = $this->doMapAccount($this->clientService->getByExternalApiRefs($customerIDs));

        foreach ($fees as $fee) {
            $this->clientTransactionFeeRateService->create([
                'ExternalReference' => $fee->FeePairingID,
                'ClientID' => $merchants['Account_' . $fee->MerchantAccountFK]['AccountID'],
                'RelatedClientID' => $customers['Account_' . $fee->CustomerAccountFK]['AccountID'],
                'StartDate' => $fee->DateApplied,
                'EndDate' => $fee->DateInactive,
                'CustomerCashFee' => $fee->CustomerCashFee,
                'MerchantCashFee' => $fee->MerchantCashFee,
                'CustomerCashPercentFee' => $fee->CustomerCashPercentFee,
                'MerchantCashPercentFee' => $fee->MerchantCashPercentFee,
                'CustomerTradeFee' => $fee->CustomerTradeFee,
                'MerchantTradeFee' => $fee->MerchantTradeFee,
                'CustomerTradePercentFee' => $fee->CustomerTradePercentFee,
                'MerchantTradePercentFee' => $fee->MerchantTradePercentFee,
                'Active' => $fee->Active ? 1 : 0,
                'DateCreated' => $fee->Created,
                'DateModified' => $fee->Modified,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration'

            ]);
        }

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
