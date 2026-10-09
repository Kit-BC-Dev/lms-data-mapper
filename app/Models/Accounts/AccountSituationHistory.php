<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountSituationHistory extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'AccountSituationHistory';

    protected $primaryKey = 'AccountSituationHistoryID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'AccountSituation',
        'Subject',
        'Type',
        'ContactDate',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy',
    ];
}
