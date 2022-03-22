<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\InventorySourceStock;

class Inventory extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'inventories';

    protected $fillable = [
        'code', 'name', 'location'
    ];

    public function source_stock()
    {
        return $this->hasMany(InventorySourceStock::class, 'inventory_id');
    }
}
