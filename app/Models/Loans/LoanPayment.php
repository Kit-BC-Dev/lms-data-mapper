<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'LoanPayments';
    protected $primaryKey = 'PaymentID';
    public $timestamps = false;

    protected $fillable = [
        'LoanID',
        'PaymentType',
        'Date',
        'DateSuccessful',
        'Amount',
        'PaymentStatus',
        'Comment',
        'ExternalAPIRef',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy'
    ];
}
