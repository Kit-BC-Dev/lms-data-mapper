<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class ClientExtra extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientExtras';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'Name',
        'Value',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy'
    ];
}
