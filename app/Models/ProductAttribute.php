<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductAttributeValues;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_attributes';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function values()
    {
        return $this->hasMany(ProductAttributeValues::class, 'attribute_id');
    }
}
