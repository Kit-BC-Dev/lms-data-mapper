<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'Addresses';
    protected $primaryKey = 'AddressID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'AddressName',
        'ExternalReference',
        'UnitNumber',
        'StreetNumber',
        'Address',
        'Suburb',
        'City',
        'State',
        'PostCode',
        'Country',
        'CreatedBy',
    ];
}
