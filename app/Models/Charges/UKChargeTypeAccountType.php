<?php

namespace App\Models\Charges;

use Illuminate\Database\Eloquent\Model;

class UKChargeTypeAccountType extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKChargeTypeAccountType';

    protected $primaryKey = 'ChargeTypeFK';
    public $timestamps = false;
}
