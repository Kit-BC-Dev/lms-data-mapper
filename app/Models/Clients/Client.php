<?php

namespace App\Models\Clients;

use App\Models\Addresses\Address;
use App\Models\Balances\ClientBalance;
use App\Models\Config\ConfigClientAccountStatus;
use App\Models\Config\ConfigClientAccountType;
use App\Models\Loans\Loan;
use App\Models\Spiel\Spiel;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'Clients';
    protected $primaryKey = 'ClientID';
    public $timestamps = false;

    protected $fillable = [
        'ParentClientID',
        'ClientTypeID',
        'ExternalAPIRef',
        'PrimaryAddressID',
        'AccountNumber',
        'ClientSourceID',
        'DemographicID',
        'FirstName',
        'LastName',
        'MiddleName',
        'Title',
        'MobileNumber',
        'WorkPhoneNumber',
        'HomePhoneNumber',
        'EmailAddress',
        'CreditLimit',
        'TimeZoneID',
        'CreatedBy',
        'DateCreated',
        'ModifiedBy',
        'DateModified',
    ];

    public function status()
    {
        return $this->hasOne(ConfigClientAccountStatus::class, 'ClientAccountStatusID', 'ClientAccountStatusID');
    }

    public function type()
    {
        return $this->hasOne(ConfigClientAccountType::class, 'ClientAccountTypeID', 'ClientAccountTypeID');
    }

    public function recentBalance()
    {
        return $this->hasOne(ClientBalance::class, 'ClientID', 'ClientID')
            ->latestOfMany('ClientBalanceID');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'ClientID', 'ClientID');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'AddressID', 'PrimaryAddressID');
    }

    public function spiel()
    {
        return $this->hasOne(Spiel::class, 'AccountClientID', 'ParentClientID');
    }
}
