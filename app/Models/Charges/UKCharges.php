<?php

namespace App\Models\Charges;

use Illuminate\Database\Eloquent\Model;

class UKCharges extends Model
{
     protected $connection = 'mysql_staging';

    protected $table = 'DBUKCharges';

    protected $primaryKey = 'ChargeID';
    public $timestamps = false;
}
