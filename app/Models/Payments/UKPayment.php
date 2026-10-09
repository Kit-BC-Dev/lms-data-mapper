<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

class UKPayment extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKPayments';
    protected $primaryKey = 'PaymentID';
    public $timestamps = false;

    public function type()
    {
        return $this->hasOne(UKPaymentType::class, 'PaymentTypeID', 'PaymentTypeFK');
    }
}
