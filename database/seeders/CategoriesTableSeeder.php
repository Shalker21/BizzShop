<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('category_breadcrumbs')->insert([
            'breadcrumb_id' => Category::first()->id,
            'breadcrumb' => Category::first()->category_translation->name,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('products')->insert([
            'category_ids' => Category::first()->id,
            'variation_ids' => null,
            'code' => 'code',
            'enabled' => true,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_translations')->insert([
            'product_id' => Product::first()->id,
            'name' => 'TEST_PRODUCT',
            'slug' => 'test-product',
            'description' => Str::random(50),
            'short_description' => Str::random(10),
            'meta_keywords' => 'test, testing, testing1',
            'meta_description' => Str::random(50),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
