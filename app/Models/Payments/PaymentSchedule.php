<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKOutlets';
    protected $primaryKey = 'OutletID';
    public $timestamps = false;
}
