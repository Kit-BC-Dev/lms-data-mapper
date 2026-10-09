<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class UKTransactionNote extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKTransactions';
    protected $primaryKey = 'TransactionID';
    public $timestamps = false;
}
