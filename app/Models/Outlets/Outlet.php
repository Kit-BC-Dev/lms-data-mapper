<?php

namespace App\Models\Outlets;

use App\Models\ClientDirectory\DirectorySpiel;
use App\Models\ClientDirectory\Directory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKOutlets';
    protected $primaryKey = 'OutletID';
    public $timestamps = false;


    public function address()
    {
        return $this->hasOne(OutletWebDirectory::class, 'OutletID', 'OutletID');
    }

    public function spiel()
    {
        return $this->hasOne(DirectorySpiel::class, 'AccountFK', 'AccountFK');
    }
    

    public function products()
    {
        return $this->hasMany(OutletProduct::class, 'OutletFK', 'OutletID');
    }

    public function people()
    {
        return $this->hasMany(OutletPerson::class, 'OutletFK', 'OutletID');
    }

}
