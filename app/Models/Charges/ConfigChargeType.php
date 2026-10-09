<?php

namespace App\Models\Charges;

use Illuminate\Database\Eloquent\Model;

class ConfigChargeType extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ConfigChargeTypes';

    protected $primaryKey = 'ChargeTypeID';
    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'Name',
        'Code',
        'Amounts',
        'MembershipDays',
        'ChargePriority',
        'Taxable',
        'CashCommissionDue',
        'TradeCommissionDue',
        'EarlyPayment',
        'Adhoc',
        'Editable',
        'Excludable',
        'Internal',
        'CreatedBy',
        'ModifiedBy',
        'DateCreated',
        'DateModified',
    ];

    protected $casts = [
        'Amounts' => 'array',
    ];
}
