<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\CategoryTranslation;
use App\Models\CategoryImage;

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
        'parent_id' =>  'string',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function parent() {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function category_translation() {
        return $this->hasOne(CategoryTranslation::class, 'category_id');
    }

    public function category_image() {
        return $this->hasOne(CategoryImage::class, 'category_id');
    }


}
