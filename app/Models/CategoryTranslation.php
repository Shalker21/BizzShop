<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Category;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'category_translation';

    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
    ];

    public function category() {
        return belongsTo(category::class, 'category_id');
    }


}
