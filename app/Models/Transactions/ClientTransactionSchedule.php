<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class ClientTransactionSchedule extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientTransactionSchedules';
    protected $primaryKey = 'ClientTransactionScheduleID';

    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'MerchantClientID',
        'CustomerClientID',
        'CustomerCardID',
        'Frequency',
        'Amount',
        'AdjustmentAmount',
        'AdjustmentDate',
        'AdjustmentFirst',
        'AdjustmentLast',
        'AgreementDate',
        'TerminationDate',
        'StartDate',
        'EndDate',
        'LastTransactionDate',
        'NextTransactionDate',
        'Notes',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy',
    ];
}
