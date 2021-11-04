<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'brands';

    protected $fillable = [
        'name', 'slug', 'logo_path',
    ];
}
