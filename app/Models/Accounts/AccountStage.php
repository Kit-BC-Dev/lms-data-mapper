<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountStage extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountStages';

    protected $primaryKey = 'AccountStageID';
    
    public $timestamps = false;
}
