<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountWebSearch extends Model
{
     protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountsWebSearch';

    protected $primaryKey = 'AccountID';
    public $timestamps = false;

}
