<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'order_number', 'status', 'total', 'email', 'item_count', 'payment_method',
        'first_name', 'last_name', 'address', 'city', 'post_code', 'phone_number'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
