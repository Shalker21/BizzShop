<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductOption;
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
            'category_ids' => [Category::first()->id],
            'variation_ids' => [null],
            'code' => 'code',
            'enabled' => true,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('brands')->insert([
            'name' => 'ADIDAS',
            'slug' => 'adidas',
            'logo_path' => 'nesto/nesto',
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

        DB::collection('product_variants')->insert([
            'product_id' => Product::first()->id,
            'images_ids' => [null],
            'code' => '123unique123',
            'available' => true,
            'width' => null,
            'height' => null,
            'depth' => null,
            'weight' => '0.5',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_variant_translations')->insert([
            'variant_id' => ProductVariant::first()->id,
            'name' => 'VARIANT_NAME',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_variant_stock_items')->insert([
            'variant_id' => ProductVariant::first()->id,
            'quantity' => 20,
            'unit_price' => 20.99,
            'unit_special_price' => null,
            'unit_special_price_from' => Carbon::now()->format('Y-m-d H:i:s'),
            'unit_special_price_to' => Carbon::now()->format('Y-m-d H:i:s'), 
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 1
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'SIZE',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 2
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'COLOR',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 3
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'MJERNE JEDINICE ZA DULJINU',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 4
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'MJERNE JEDINICE ZA MASU',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 5
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'MJERNE JEDINICE ZA VOLUMEN TEKUĆINE',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 6
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'MJERNE JEDINICE ZA VRIJEME',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 7
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'MJERNE JEDINICE ZA POVRŠINU',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // 8
        DB::collection('product_options')->insert([
            'code' => uniqid(),
            'name' => 'MJERNE JEDINICE ZA OBUJAM',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::first()->id,
            'code' => uniqid(),
            'value' => 'XL',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::first()->id,
            'code' => uniqid(),
            'value' => 'S',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::first()->id,
            'code' => uniqid(),
            'value' => 'M',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(1)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'RED',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(1)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'BLUE',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(2)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'kilometar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(2)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'metar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(2)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'decimetar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(2)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'centimetar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(2)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'milimetar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(3)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'tona',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(3)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'kilogram',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(3)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'dekagram',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(3)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'gram',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(4)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'hektolitar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(4)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'litra',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(4)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'decilitar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(4)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'mililitar',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(5)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'dan',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(5)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'sat',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(5)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'minuta',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::collection('product_option_values')->insert([
            'option_id' => ProductOption::skip(5)->take(1)->first()->id,
            'code' => uniqid(),
            'value' => 'sekunda',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
    }
}
