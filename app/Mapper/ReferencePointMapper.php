<?php

namespace App\Mapper;

use App\DTO\ReferencePointDTO;
use DB;

class ReferencePointMapper
{
    public function map(array $referencePoint): ReferencePointDTO
    {
        return new ReferencePointDTO(
            ClientDirectoryID: $referencePoint['ClientDirectoryID'],
            AccountClientID: $referencePoint['AccountClientID'],
            OutletClientID: $referencePoint['OutletID'],
            ReferencePoint: DB::raw('ST_SRID(POINT(0,0),4326)')
        );
    }
}