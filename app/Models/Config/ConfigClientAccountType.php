<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigClientAccountType extends Model
{
     protected $connection = 'mysql_staging';

    protected $table = 'ConfigClientAccountTypes';
    protected $primaryKey = 'ClientAccountTypeID';
    public $timestamps = true;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'Name',
        'Description',
        'IsStaff',
        'SendDirectory',
        'IsBottomReport',
        'InDirectory',
        'SellOnWeb',
        'SendPaperStatement',
        'Active',
        'CreatedBy',
        'DateCreated',
        'ModifiedBy',
        'DateModified',
    ];
}
