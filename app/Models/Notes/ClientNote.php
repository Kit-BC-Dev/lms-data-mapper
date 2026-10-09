<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Model;

class ClientNote extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientNotes';
    protected $primaryKey = 'ClientNoteID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'ExternalReference',
        'NoteType',
        'NoteSubject',
        'NoteText',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy',
    ];

}
