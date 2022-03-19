<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductImage extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_images';

    protected $fillable = [
        'product_id', 'variant_id', 'type', 'path',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'image_ids');
    }
}
