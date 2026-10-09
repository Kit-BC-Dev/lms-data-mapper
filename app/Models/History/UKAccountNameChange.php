<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;

class UKAccountNameChange extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountNameChanges';
    protected $primaryKey = 'AccountNameChangeID';
    public $timestamps = false;
}
