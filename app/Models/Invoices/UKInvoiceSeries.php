<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Model;

class UKInvoiceSeries extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKInvoiceSeries';
    protected $primaryKey = 'InvoiceSeriesID';
    public $timestamps = false;
}
