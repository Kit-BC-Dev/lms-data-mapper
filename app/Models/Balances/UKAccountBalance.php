<?php

namespace App\Models\Balances;

use Illuminate\Database\Eloquent\Model;

class UKAccountBalance extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountBalances';
    protected $primaryKey = 'AccountFK';
    public $timestamps = false;

    public $incrementing = false;
}
