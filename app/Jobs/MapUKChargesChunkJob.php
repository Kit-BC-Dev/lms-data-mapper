<?php

namespace App\Jobs;

use App\Mapper\ClientChargeMapper;
use App\Repositories\UKChargesRepository;
use App\Services\ClientBalanceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Services\ConfigChargeTypeService;
use App\Services\ClientService;
use App\Services\ClientChargeService;

use App\Traits\DataMapper;

use DB;
class MapUKChargesChunkJob implements ShouldQueue
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
        UKChargesRepository $uKChargesRepository,
        ConfigChargeTypeService $configChargeTypeService,
        ClientService $clientService,
        ClientChargeService $clientChargeService,
        ClientChargeMapper $clientChargeMapper,
        ClientBalanceService $clientBalanceService
    ): void
    {
        $charges = $uKChargesRepository->getChunk($this->ids);
        $chargeTypeReferences = [];
        $accountReferences = [];
        $clientCharges = [];
        $accountBalances = [];

        foreach ($charges as $charge) {
            if (!in_array('Account_' . $charge->AccountFK, $accountReferences)) {
                $accountReferences[] = 'Account_' . $charge->AccountFK;
            }

            if (!in_array('ChargeType_' . $charge->ChargeTypeFK, $chargeTypeReferences)) {
                $chargeTypeReferences[] = 'ChargeType_' . $charge->ChargeTypeFK ;
            }
            
            
        }

        $newChargeTypes = $configChargeTypeService->getByExterReferences($chargeTypeReferences);

        $accounts = $this->doMapAccount($clientService->getByExternalApiRefs($accountReferences));
        $chargeTypes = $newChargeTypes->mapWithKeys(fn ($chargeType) => [
            $chargeType->ExternalReference => [
                'ChargeTypeID' => $chargeType->ChargeTypeID,
            ],
        ])->all();
        $seenAccountID = [];
        foreach ($charges as $charge) {
            $account = $accounts['Account_' . $charge->AccountFK];
            $accountID =  $account['AccountID'];
            $tradeBalance = $account['TradeBalance'];
            $cashBalance = $account['CashBalance'];

            $dto = $clientChargeMapper->map(
                $charge->toArray(),
                $accountID,
                $chargeTypes['ChargeType_' . $charge->ChargeTypeFK]['ChargeTypeID']
            );

            $clientCharges[] = $dto->toArray();
            if (in_array($accountID, $seenAccountID)) {
                
            }
        }

        $clientChargeService->create($clientCharges);


        logger()->info([
            'data_mapped_so_far' => $this->total,
            'table' => 'client_charges',
        ]);
        
    }
}
