<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountStatus extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKlkpAccountStatus';
    public $timestamps = false;
}
