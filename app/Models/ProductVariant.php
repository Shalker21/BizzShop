<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductVariantStockItem;
use App\Models\ProductVariantTranslation;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_variants';

    protected $fillable = [
        'product_id', 'image_ids', 'option_ids', 'optionValue_ids', 'code', 'available', ' width', 'height', 'depth', 'weight',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'image_ids');
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'variant_id');
    }

    public function stock_item()
    {
        return $this->hasOne(ProductVariantStockItem::class, 'variant_id');
    }

    public function variant_translation()
    {
        return $this->hasOne(ProductVariantTranslation::class, 'variant_id');
    }
}
