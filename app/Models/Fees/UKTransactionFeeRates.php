<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Model;

class UKTransactionFeeRates extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKTransactionFeeRates';
    protected $primaryKey = 'FeeRateID';
    public $timestamps = false;
}
