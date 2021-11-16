<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductTranslation;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'category_ids', 'variation_ids', 'code', 'enabled',
    ];

    protected $casts = [
        'variation_ids' => 'collection',
        'category_ids' => 'collection',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'category_ids');
    }

    public function product_translation()
    {
        return $this->hasOne(ProductTranslation::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function attribute_values()
    {
        return $this->hasMany(ProductAttributeValue::class, 'product_id'); // don't see usage in app, but it's good to have this relationship
    }


}
