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
    protected $collection = 'inventories';

    protected $fillable = [
        'product_id', 'variant_id', 'inventory_id', 'code', 'stock', 'available'
    ];

    public function source_stock()
    {
        // _id or id ????
        return $this->belongsTo(inventory::class, '_id');
    }

    public function product()
    {
        // _id or id ????
        return $this->belongsTo(Product::class, '_id');
    }

    public function variant()
    {
        // _id or id ????
        return $this->belongsTo(ProductVariant::class, '_id');
    }
}
