<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountDetails';
    public $timestamps = false;
}
