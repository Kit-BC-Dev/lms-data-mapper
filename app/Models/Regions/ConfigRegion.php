<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Model;

class ConfigRegion extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ConfigRegions';
    protected $primaryKey = 'RegionID';
    public $timestamps = true;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'ExternalReference',
        'Region',
        'Active',
        'Order',
        'CreatedBy',
        'DateCreated',
        'DateModified',
        'ModifiedBy'
    ];
}
