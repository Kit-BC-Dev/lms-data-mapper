<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKlkpAccountTypes';
    public $timestamps = false;
}
