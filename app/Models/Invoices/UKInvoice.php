<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Model;

class UKInvoice extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKInvoices';
    protected $primaryKey = 'InvoiceID';
    public $timestamps = false;
}
