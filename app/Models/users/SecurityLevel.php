<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Model;

class SecurityLevel extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'SecurityLevels';
    protected $primaryKey = 'SecurityLevelID';
    const UPDATED_AT = 'DateModified';
    const CREATED_AT = 'DateCreated';

    protected $fillable = ['SecurityLevel', 'Active', 'CreatedBy', 'ModifiedBy'];
}
