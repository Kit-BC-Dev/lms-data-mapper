<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

use App\Models\Config\ConfigClientAccountStatus;
use App\Models\Config\ConfigClientAccountType;
class DBUKAccountStatus extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKAccountStatus';

    protected $primaryKey = 'AccountFK';

    public $incrementing = false;
    public $timestamps = false;

    public function status()
    {
        return $this->hasOne(ConfigClientAccountStatus::class, 'DisplayName', 'AccountStatus');
    }

    public function type()
    {
        return $this->hasOne(ConfigClientAccountType::class, 'Name', 'AccountType');
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'AccountID', 'AccountFK');
    }
}
