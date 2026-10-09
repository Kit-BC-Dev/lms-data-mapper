<?php

namespace App\Models\Spiel;

use Illuminate\Database\Eloquent\Model;

class Spiel extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientDirectorySpiels';
    protected $primaryKey = 'ClientDirectorySpielID';
    public $timestamps = false;

    protected $fillable = [
        'AccountClientID',
        'ExternalReference',
        'Content',
        'CreatedBy',
        'DateCreated',
        'DateModified',
        'ModifiedBy'
    ];
    
}
