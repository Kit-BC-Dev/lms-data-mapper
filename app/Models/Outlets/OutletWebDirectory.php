<?php

namespace App\Models\Outlets;

use Illuminate\Database\Eloquent\Model;

class OutletWebDirectory extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKOutletsWebDir';
    protected $primaryKey = 'OutletID';
    public $timestamps = false;
}
