<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class ClientOutletAdditionalContact extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientOutletAdditionalContacts';
    protected $primaryKey = 'ClientOutletAdditionalContactID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'Title',
        'FirstName',
        'LastName',
        'Email',
        'BusinessName',
        'Role',
        'BusinessPhone',
        'HomePhone',
        'Mobile',
        'Fax',
    ];
}
