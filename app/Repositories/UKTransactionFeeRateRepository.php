<?php

namespace App\Repositories;

use App\Models\Fees\UKTransactionFeeRates;

class UKTransactionFeeRateRepository extends BaseUKRepository
{
    public function __construct(private UKTransactionFeeRates $uKTransactionFeeRates)
    {
        parent::__construct(
            model: $this->uKTransactionFeeRates,
            field: 'FeeRateID',
        );
    }
}