<?php

namespace App\Models\Charges;

use Illuminate\Database\Eloquent\Model;

class UKChargeType extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKChargeTypes';

    protected $primaryKey = 'ChargeTypeID';
    public $timestamps = false;

    public function types()
    {
        return $this->hasMany(UKChargeTypeAccountType::class, 'ChargeTypeFK', 'ChargeTypeID');
    }
}
