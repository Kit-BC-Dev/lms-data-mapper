<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Model;

class UKFeePairing extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKFeePairing';
    protected $primaryKey = 'FeeParigingID';
    public $timestamps = false;

}
