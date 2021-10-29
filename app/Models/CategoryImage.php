<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Category;

class CategoryImage extends Model
{
    use HasFactory;
    
    protected $connection = 'mongodb';
    protected $collection = 'category_images';

    //protected $with = ['category_translation', /*'category_image'*/];

    protected $fillable = [
        'category_id', 'path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


}
