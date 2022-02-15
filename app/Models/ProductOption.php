<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductOptionValue;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductOption extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_options';

    protected $fillable = ['optionValue_ids', 'code', 'name'];
    /*public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variants()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }*/

    public function values()
    {
        return $this->hasMany(ProductOptionValue::class, 'option_id');
    }
}
