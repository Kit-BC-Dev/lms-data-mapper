<?php

namespace App\Repositories;
use App\Models\Outlets\Outlet;

class UKDirectoryRepository extends BaseUKRepository
{
    public function __construct(Outlet $model)
    {
        parent::__construct(
            $model,
            'OutletID',
            ['address', 'spiel', 'spiel.directory', 'products.product.category', 'people']
        );
    }
}