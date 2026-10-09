<?php

namespace App\Models\Changes;

use Illuminate\Database\Eloquent\Model;

class AuditedChanges extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAuditedChanges';

    protected $primaryKey = 'AuditedChangeID';
    public $timestamps = false;

}
