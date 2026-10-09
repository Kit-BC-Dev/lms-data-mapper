<?php

namespace App\Models\Person;

use Illuminate\Database\Eloquent\Model;

class UKPerson extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKPersons';
    protected $primaryKey = 'PersonID';
    public $timestamps = false;

}
