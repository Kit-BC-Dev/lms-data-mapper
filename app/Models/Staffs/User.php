<?php

namespace App\Models\Staffs;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'Users';
    protected $primaryKey = 'UserID';

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'ExternalReference',
        'SecurityLevelID',
        'Active',
        'FirstName',
        'CreatedBy',
        'ModeifiedBy'
    ];
}
