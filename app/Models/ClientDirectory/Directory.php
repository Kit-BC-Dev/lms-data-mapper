<?php

namespace App\Models\ClientDirectory;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKDirectory';
    protected $primaryKey = 'DirectoryID';
    public $timestamps = false;
}
