<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\CategoryTranslation;
use App\Models\CategoryBreadcrumbs;
use App\Models\CategoryImage;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'categories';

    //protected $with = ['category_translation', /*'category_image'*/];

    protected $fillable = [
        'parent_id', 'product_ids', 'featured', 'menu',
    ];

    protected $casts = [
        'parent_id' => 'string',
        'product_ids' => 'array',
        'featured' => 'boolean',
        'menu' => 'boolean'
    ];

    public function parent() {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function parents() {
        return $this->parent()->with('parents');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrens() { // FIXME: do we use this function? 
        return $this->hasMany(Category::class, 'parent_id')->with('childrens');
    }

    public function category_translation() {
        return $this->hasOne(CategoryTranslation::class, 'category_id');
    }

    public function category_image() {
        return $this->hasOne(CategoryImage::class, 'category_id');
    }

    public function category_breadcrumbs() {
        return $this->hasOne(CategoryBreadcrumbs::class, 'breadcrumb_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, null, 'product_ids', 'category_ids'); // mabye I'm reversed prod_ids and cat_ids ???????? maybe this is good!
    }
}
