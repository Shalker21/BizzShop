<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Category;

class CategoryBreadcrumbs extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'category_breadcrumbs';

    protected $fillable = [
        'breadcrumb_id', 'breadcrumb',
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'breadcrumb_id', 'breadcrumb_id');
    }
}
