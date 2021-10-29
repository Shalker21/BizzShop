<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\CategoryTranslation;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'categories';

    //protected $with = ['category_translation', /*'category_image'*/];

    protected $fillable = [
        'parent_id', 'featured', 'menu',
    ];

    protected $casts = [
        'parent_id' =>  'integer',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function category_translation() {
        return $this->hasOne(CategoryTranslation::class, 'category_id');
    }

}
