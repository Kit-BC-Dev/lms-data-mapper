<?php

namespace App\Models\Outlets;

use Illuminate\Database\Eloquent\Model;

class OutletPerson extends Model
{
    
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKOutletsPeople';
    public $timestamps = false;

}
 