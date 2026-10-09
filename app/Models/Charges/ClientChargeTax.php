<?php

namespace App\Models\Charges;

use Illuminate\Database\Eloquent\Model;

class ClientChargeTax extends Model
{
     protected $connection = 'mysql';

    protected $primaryKey = 'ClientChargeTaxID';

    protected $timestamps = false;
}
