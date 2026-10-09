<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;

class FieldHistory extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'FieldHistory';
    protected $primaryKey = 'FieldHistoryID';
    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'ExternalID',
        'Table',
        'Field',
        'OldValue',
        'NewValue',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy'
    ];
}
