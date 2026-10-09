<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;

class UKAccountTypeChange extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountTypeChanges';
    protected $primaryKey = 'AccountTypeChangeID';
    public $timestamps = false;
}
