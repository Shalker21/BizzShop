<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'parent_id' =>  null,
            'featured' => false,
            'menu' =>  false,
        ]);

        DB::table('category_translation')->insert([
            'category_id' => Category::first()->id,
            'name' => 'Root',
            'slug' => 'root',
            'description' => Str::random(20), 
        ]);
    }
}
