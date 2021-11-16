<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\ProductOption;

class ProductOptionValue extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_option_values';

    public function option()
    {
        return $this->belongsTo(ProductOption::class, 'option_id');
    }
}
