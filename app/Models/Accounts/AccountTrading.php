<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountTrading extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountTrading';
    public $timestamps = false;
}
