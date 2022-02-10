<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\ProductVariant;

class ProductVariantTranslation extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_variant_translations';

    protected $fillable = [
        'variant_id', 'name',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
