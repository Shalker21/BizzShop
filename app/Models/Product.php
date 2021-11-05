<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductTranslation;

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


}
