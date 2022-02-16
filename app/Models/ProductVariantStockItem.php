<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\ProductVariant;

class ProductVariantStockItem extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_variant_stock_items';

    protected $fillable = [
        'variant_id', 'quantity', 'unit_price', 'unit_special_price', 'unit_special_price_from', 'unit_special_price_to',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
