<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;

class ClientBank extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientBanks';
    protected $primaryKey = 'BankID';
    public $timestamps = true;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'ClientID',
        'BSB',
        'AccountNumber',
        'ExternalReference',
        'AccountName',
        'AccountType',
        'ExpiryDate',
        'Active',
        'CreatedBy',
        'ModifiedBy',
    ];
}
