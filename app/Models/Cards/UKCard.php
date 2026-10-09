<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;
use App\Models\CardStatuses\CardStatus;
class UKCard extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKCards';

    protected $primaryKey = 'CardID';
    public $timestamps = false;

    public function status()
    {
        return $this->belongsTo(CardStatus::class, 'CardStatus', 'Name');
    }
}
