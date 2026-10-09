<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class UKScheduledTransaction extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKScheduledTransactions';
    protected $primaryKey = 'ADATransactionID';

    public $timestamps = false;
}
