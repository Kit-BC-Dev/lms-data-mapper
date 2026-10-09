<?php

namespace App\Models\ClientRelationship;

use Illuminate\Database\Eloquent\Model;

class ClientRelationship extends Model
{
    protected $connection = 'mysql';

    protected $table = 'ClientRelationships';
    protected $primaryKey = 'ClientRelationshipID';
    public $timestamps = false;

    protected $fillable = [
        'RelationshipTypeID',
        'ClientID',
        'RelatedClientID',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy'
    ];
}
