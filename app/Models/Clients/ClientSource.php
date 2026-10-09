<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class ClientSource extends Model
{
    
    protected $connection = 'mysql_staging';

    protected $table = 'ClientSources';
    protected $primaryKey = 'ClientSourceID';
    public $timestamps = true;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'Name',
        'Active',
        'FrontEnd',
        'CreatedBy',
        'ModifiedBy',
    ];
}
