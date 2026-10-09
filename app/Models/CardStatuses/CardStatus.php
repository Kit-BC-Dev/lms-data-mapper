<?php

namespace App\Models\CardStatuses;

use Illuminate\Database\Eloquent\Model;

class CardStatus extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ConfigCardStatuses';

    protected $primaryKey = 'CardStatusID';
    public $timestamps = false;
}
