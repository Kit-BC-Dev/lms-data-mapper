<?php

namespace App\Models\ClientDirectory;

use Illuminate\Database\Eloquent\Model;

class DirectorySpiel extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKDirectorySpiel';
    protected $primaryKey = 'SpielID';
    public $timestamps = false;

    public function directory()
    {
        return $this->hasOne(Directory::class, 'SpielFK', 'SpielID');
    }

}
