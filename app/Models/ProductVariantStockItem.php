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

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
