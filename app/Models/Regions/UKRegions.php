<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Model;

class UKRegions extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKRegions';
    protected $primaryKey = 'RegionID';
    public $timestamps = false;

}
