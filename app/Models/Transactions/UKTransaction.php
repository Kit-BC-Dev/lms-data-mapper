<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class UKTransaction extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKTransactions';
    protected $primaryKey = 'TransactionID';
    public $timestamps = false;

    public function note()
    {
        return $this->hasOne(UKTransactionNote::class, 'TransactionID', 'TransactionFK');
    }
}
