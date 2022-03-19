<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantStockItem extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_variant_stock_items';

    protected $fillable = [
        'variant_id', 'product_id', 'quantity', 'unit_price', 'unit_special_price', 'unit_special_price_from', 'unit_special_price_to', 'width_measuring_unit_option_value_id', 'height_measuring_unit_option_value_id', 'depth_measuring_unit_option_value_id', 'weight_measuring_unit_option_value_id'
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'variant_id');
    }
}
