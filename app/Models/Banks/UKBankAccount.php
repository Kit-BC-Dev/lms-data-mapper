<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;

class UKBankAccount extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKBankAccounts';
    protected $primaryKey = 'BankAccountID';
    public $timestamps = false;
}
