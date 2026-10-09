<?php

namespace App\Models\Outlets;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;
class OutletProduct extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKOutletsProducts';
    protected $primaryKey = 'OutletProductsID';
    public $timestamps = false;

     public function product()
    {
        return $this->belongsTo(
            Product::class,
            'ProductFK', 
            'ProductID'
        );
    }
}
