<?php

namespace App\Models\Staffs;

use Illuminate\Database\Eloquent\Model;

class UKStaff extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKStaff';
    protected $primaryKey = 'StaffID';

}
