<?php

namespace App\Models\ClientService;

use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientServices';
    protected $primaryKey = 'ClientServiceID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'ClientDirectoryCategoryID',
        'ExternalReference',
        'ServiceType',
        'AdditionalProductInformation',
        'Status',
        'NumberOfStars',
        'ContactBroker',
        'LimitedSupply',
        'HardcopyDirectory',
        'WebDirectory',
        'ContactText',
        'Active',
        'DateInactive',
        'ReasonInactive',
        'Graphic',
        'UseOutletPhone',
        'ListPhone',
        'ListFax',
        'ListEmail',
        'ListWeb',
        'ListOtherPhone',
        'UsePostalAddress',
        'UseStreetAddress',
        'ListSuburb',
        'ListState',
        'CreatedBy',
        'DateCreated',
        'ModifiedBy',
        'DateModified',
    ];
}
