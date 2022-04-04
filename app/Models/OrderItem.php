<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'order_items';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'special_price'
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
