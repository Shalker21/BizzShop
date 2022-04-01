<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'inventories';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
