<?php

namespace App\Models\ClientRelationship;

use Illuminate\Database\Eloquent\Model;

class RelationshipTypes extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'RelationshipTypes';
    protected $primaryKey = 'RelationshipTypeID';
    public $timestamps = false;
}
