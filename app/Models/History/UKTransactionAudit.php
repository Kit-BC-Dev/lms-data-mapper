<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;

class UKTransactionAudit extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKTransactionsAudit';
    protected $primaryKey = 'TransactionsAuditID';
    public $timestamps = false;
}
