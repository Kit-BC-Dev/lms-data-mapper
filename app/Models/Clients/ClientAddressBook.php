<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class ClientAddressBook extends Model
{
     protected $connection = 'mysql_staging';

    protected $table = 'ClientAddressBook';
    protected $primaryKey = 'ClientAddressBook';
    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'ExternalReference',
        'AccountClientID',
        'PersonClientID',
        'OtherPartyNickName',
        'OtherPartyAccountNumber',
        'OtherPartyCardNumber',
        'OtherPartyRelationship',
        'CreateeBy',
        'ModifiedBy',
    ];

}
