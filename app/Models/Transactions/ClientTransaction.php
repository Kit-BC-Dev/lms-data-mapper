<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class ClientTransaction extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientTransactions';
    protected $primaryKey = 'ClientTransactionID';

    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'TransactionSource',
        'TransactionTypeID',
        'TransactionStatusID',
        'AuthorisationStatus',
        'AuthorisationNumber',
        'AuthorisationNumberPrefix',
        'AuthorisationTimestamp',
        'AuthorisationSource',
        'AuthorisationCancelledTimestamp',
        'MerchantClientID',
        'CustomerClientID',
        'MerchantCardID',
        'CustomerCardID',
        'Date',
        'DateEffective',
        'DateProcessed',
        'CashAmount',
        'TradeAmount',
        'TradeAuthorisationAmount',
        'MerchantCashFees',
        'CustomerCashFees',
        'MerchantTradeFees',
        'CustomerTradeFees',
        'Notes',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy',
    ];
}
