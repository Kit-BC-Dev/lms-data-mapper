<?php

namespace App\Models\Demographics;

use Illuminate\Database\Eloquent\Model;

class Demographic extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'Demographics';
    protected $primaryKey = 'DemographicID';
    public $timestamps = true;

    protected $fillable = [
        'Name',
        'CreatedBy',
        'ModifiedBy'
    ];
    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';
}
