<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Model;

class UKAddress extends Model
{
    
    protected $connection = 'mysql_staging';

    protected $table = 'Addresses';
    protected $primaryKey = 'AddressID';
    public $timestamps = false;
}
