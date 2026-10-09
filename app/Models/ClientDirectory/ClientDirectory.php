<?php

namespace App\Models\ClientDirectory;

use Illuminate\Database\Eloquent\Model;

class ClientDirectory extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientDirectory';
    protected $primaryKey = 'ClientDirectoryID';
    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'AccountClientID',
        'ClientDirectorySpielID',
        'Name',
        'Active',
        'ReasonInactive',
        'DateInactive',
        'InternationalListing',
        'NationalListing',
        'RegionalListing',
        'ShowAllOutlets',
        'CreatedBy',
        'DateCreated',
        'ModifiedBy',
        'DateModified',
    ];

    public function getOutletDirectory(int $spielID, int $accountClientID)
    {
        return $this->where('ClientDirectorySpielID', $spielID)
        ->where('AccountClientID', $accountClientID)->first();
    }
}