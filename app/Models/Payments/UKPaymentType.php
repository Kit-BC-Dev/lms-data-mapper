<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

class UKPaymentType extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKPaymentTypes';
    protected $primaryKey = 'PaymentTypeID';
    public $timestamps = false;
}
