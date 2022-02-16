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

    protected $fillable = ['option_id', 'code', 'value'];
    
    public function option()
    {
        return $this->belongsTo(ProductOption::class, 'option_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductOption::class, 'id');
    }
}
