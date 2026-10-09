<?php

namespace App\Models\ClientDirectory;

use Illuminate\Database\Eloquent\Model;

class ClientDirectoryCategory extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientDirectoryCategories';
    protected $primaryKey = 'ClientDirectoryCategoryID';
    public $timestamps = false;
}
