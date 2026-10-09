<?php

namespace App\Repositories;

use App\Models\ClientDirectory\ClientDirectoryReferencePoint;
use DB;

class ReferencePointRepository
{
    public function __construct(protected ClientDirectoryReferencePoint $clientDirectoryReferencePoint){}

    public function updateOrCreate(array $data)
    {
        DB::connection('mysql_staging')
        ->table('ClientDirectoryReferencePoints')
        ->upsert(
            $data,
            [
                'ClientDirectoryID',
                'AccountClientID',
                'OutletClientID',
            ]
        );
    }
}