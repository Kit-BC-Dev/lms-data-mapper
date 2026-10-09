<?php

namespace App\Console\Commands;

use App\Services\ConfigClientAccountTypeService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Services\ConfigChargeTypeService;
use App\Services\UKChargeTypeService;

#[Signature('app:map-ctt')]
#[Description('Command description')]
class MapUKChargeTypeToConfigChargeTypeTable extends Command
{
    public function __construct(
        protected ConfigChargeTypeService $configChargeTypeService,
        protected UKChargeTypeService $uKChargeTypeService,
        protected ConfigClientAccountTypeService $configClientAccountTypeService
    ){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Charge Types to Config Charge Types table...');

        $ukChargeTypes = $this->uKChargeTypeService->get();

        foreach ($ukChargeTypes as $chargeType) {
            $amounts = [];
            foreach ($chargeType->types as $type) {
                $accountType = $this->configClientAccountTypeService->getByName([$type->AccountType])->first();

                if ($accountType) {
                    $amounts[$accountType['Name']] = [
                        'Restrictions' => [
                            'ClientAccountTypeID' => $accountType['ClientAccountTypeID'],
                        ],
                        'AmountType' => 'Bartercard Standard Amounts',
                        'CashAmount' => $type->CashAmount,
                        'CashPercentage' => $type->CashPercentage,
                        'TradeAmount' => $type->TradeAmount,
                        'TradePercentage' => $type->TradePercentage,
                    ];
                }
            }

            $this->configChargeTypeService->create([
                'ExternalReference' => 'ChargeType_' . $chargeType->ChargeTypeID,
                'Name' => $chargeType->Description,
                'Code' => $chargeType->Code,
                'Amounts' => $amounts,
                'MembershipDays' => $chargeType->MembershipDays ? $chargeType->MembershipDays : 0,
                'ChargePriority' => $chargeType->ChargePriority ?? 0,
                'Taxable' => $chargeType->Taxable ? 1 : 0,
                'CashCommissionDue' => $chargeType->CashCommissionDue ? 1 : 0,
                'TradeCommissionDue' => $chargeType->TradeCommissionDue ? 1: 0,
                'EarlyPayment' => $chargeType->EarlyPayment ? 1: 0,
                'Adhoc' => $chargeType->AdHoc ? 1 : 0,
                'Editable' => $chargeType->Editable ? 1 : 0,
                'Excludable' => $chargeType->Excludable ? 1: 0,
                'Internal' => $chargeType->Internal ? 1 : 0,
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration',
                'DateCreated' => $chargeType->Created ?? '',
                // 'DateModified' => $chargeType->Modified ?? ''
            ]);
        }
        

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
