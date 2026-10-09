<?php

namespace App\Models\Accounts;

use App\Models\Contacts\DBUKContact;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccounts';

    protected $primaryKey = 'AccountID';
    public $timestamps = false;

    public function details()
    {
        return $this->hasOne(AccountDetail::class, 'AccountFK', 'AccountID');
    }

    public function trading()
    {
        return $this->hasOne(AccountTrading::class, 'AccountFK', 'AccountID');
    }

    public function web()
    {
        return $this->hasOne(AccountWebSearch::class, 'AccountID', 'AccountID');
    }



}
