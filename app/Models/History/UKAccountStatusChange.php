<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;

class UKAccountStatusChange extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountStatusChanges';
    protected $primaryKey = 'AccountStatusChangeID';
    public $timestamps = false;
}
