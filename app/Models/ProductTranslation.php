<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Product;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_translations';

    protected $fillable = [
        'product_id', 
        'name', 
        'slug', 
        'description', 
        'short_description', 
        'meta_keywords', 
        'meta_description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
