<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Model;

class ClientTransactionFeeRate extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientTransactionFeeRates';
    protected $primaryKey = 'ClientTransactionFeeRateID';
    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'ClientID',
        'RelatedClientID',
        'StartDate',
        'EndDate',
        'CustomerCashFee',
        'MerchantCashFee',
        'CustomerCashPercentFee',
        'MerchantCashPercentFee',
        'CustomerTradeFee',
        'MerchantTradeFee',
        'CustomerTradePercentFee',
        'MerchantTradePercentFee',
        'Active',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy',
    ];
}
