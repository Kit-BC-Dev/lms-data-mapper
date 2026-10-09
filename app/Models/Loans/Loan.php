<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'Loans';
    protected $primaryKey = 'LoanID';
    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'ClientID',
        'AddressID',
        'LoanStatusID',
        'ProductID',
        'LoanApproval',
        'LoanStartDate',
        'RepaymentStartDate',
        'RepaymentFrequency',
        'LoanType',
        'CreatedBy',
        'ModifiedBy',
    ];
}
