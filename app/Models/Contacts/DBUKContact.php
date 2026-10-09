<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Model;

class DBUKContact extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKContacts';
    protected $primaryKey = 'ContactID';
    public $timestamps = false;
}
