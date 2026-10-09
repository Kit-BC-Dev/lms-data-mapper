<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigClientAccountStatus extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ConfigClientAccountStatuses';
    protected $primaryKey = 'ClientAccountStatusID';
    public $timestamps = true;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'Name',
        'DisplayName',
        'Description',
        'BuyEnabled',
        'SellEnabled',
        'InDirectory',
        'Active',
        'CreatedBy',
        'DateCreated',
        'ModifiedBy',
        'DateModified',
    ];
}
