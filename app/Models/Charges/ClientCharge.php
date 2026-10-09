<?php

namespace App\Models\Charges;

use Illuminate\Database\Eloquent\Model;

class ClientCharge extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientCharges';

    protected $primaryKey = 'ClientChargeID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'ChargeTypeID',
        'ExternalReference',
        'Date',
        'DateEffective',
        'CashAmount',
        'TradeAmount',
        'Reversed',
        'IsIncome',
        'Processed',
        'SystemAdjustment',
        'Note',
        'CashBalance',
        'CashReversed',
        'WebCharge',
        'CashTaxValue',
        'TradeTaxValue',
        'CashTaxReversed',
        'CashTaxBalance',
        'TaxRate',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy',
    ];
}
