<?php

namespace App\Models\ClientDirectory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientDirectoryReferencePoint extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientDirectoryReferencePoints';
    protected $primaryKey = 'ClientDirectoryReferencePointID';
    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    protected $fillable = [
        'ClientDirectoryID',
        'AccountClientID',
        'OutletClientID',
        'ReferencePoint',
        'CreatedBy',
        'DateCreated',
        'ModifiedBy',
        'DateModified',
    ];

    public function getClientDirectoryReferencePoint(int $outletID, int $accountID, int $clientDirectoryID)
    {
        return DB::connection('mysql_staging')->table('ClientDirectoryReferencePoints')
        ->where('OutletClientID', $outletID)
        ->where('AccountClientID', $accountID)
        ->where('ClientDirectoryID', $clientDirectoryID)
        ->first();

    }

    public function insert(array $data)
    {
       
        return DB::connection('mysql_staging')->table('ClientDirectoryReferencePoints')
        ->insert($data);
    }
}
