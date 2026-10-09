<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Model;

class ConfigInvoiceSeries extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ConfigInvoiceSeries';
    protected $primaryKey = 'InvoiceSeriesID';
    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'SeriesName',
        'SeriesStartDate',
        'SeriesEndDate',
        'SeriesMonth',
        'SeriesYear',
        'IsCurrent',
        'DateClosed',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy',
    ];
}
