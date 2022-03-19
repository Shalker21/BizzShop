<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductAttribute;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_attribute_values';

    protected $fillable = ['product_id', 'attribute_id', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }
}
