<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientDirectory\ClientDirectoryCategory;
class Product extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'DBUKProductsII';
    protected $primaryKey = 'ProductID';
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(
            ClientDirectoryCategory::class,
            'L1Code',
            'ExternalReference'
        );
    }
}
