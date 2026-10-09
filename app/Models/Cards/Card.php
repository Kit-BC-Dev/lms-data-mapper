<?php

namespace App\Models\Cards;

use App\Models\Clients\Client;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $connection = 'mysql';

    protected $table = 'Cards';

    protected $primaryKey = 'CardID';
    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'AccountClientExternalReference',
        'AccountClientID',
        'HolderClientExternalReference',
        'HolderClientID',
        'CardTypeID',
        'CardStatusID',
        'CardNumber',
        'CardIndex',
        'CardLine1',
        'CardLine2',
        'BuyEnabled',
        'SellEnabled',
        'IssueDate',
        'ExpiryDate',
        'CancelDate',
        'CreatedBy',
        'ModifiedBy',
        'DateCreated',
        'DateModified',
    ];

    public function acounts()
    {
        return $this->hasMany(Client::class, 'ClientID', 'AccountClientID');
    }

    public function accountClient()
    {
        return $this->belongsTo(
            Client::class,
            'AccountClientID',
            'ClientID'
        );
    }



}
