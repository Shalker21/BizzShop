<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductVariant;

class InventorySourceStock extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'inventory_source_stocks';

    protected $fillable = [
        'product_id', 'variant_id', 'inventory_id', 'code', 'stock',
    ];

    public function inventory()
    {
        // _id or id ????
        return $this->belongsTo(inventory::class, 'id');
    }

    public function product()
    {
        // _id or id ????
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant()
    {
        // _id or id ????
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
