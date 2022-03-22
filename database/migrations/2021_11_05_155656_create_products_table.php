<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function ($collection) {
            $collection->id();
            $collection->index('category_ids');
            $collection->index('variant_ids');
            $collection->index('option_ids');
            $collection->index('optionValue_ids');
            $collection->index('attribute_ids');
            $collection->index('attributeValue_ids');
            $collection->index('inventory_ids');
            $collection->index('brand_id');
            $collection->string('code');
            $collection->string('quantity_total');
            $collection->boolean('enabled')->default(0);

            $collection->string('width');
            $collection->string('height');
            $collection->string('depth');
            $collection->string('weight');

            $collection->foregin('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $collection->foregin('category_ids')->references('id')->on('categories')->onDelete('cascade');
            $collection->foregin('variant_ids')->references('id')->on('product_variants')->onDelete('cascade');
            $collection->foregin('option_ids')->references('id')->on('product_options')->onDelete('cascade');
            $collection->foregin('optionValue_ids')->references('id')->on('product_option_values')->onDelete('cascade');
            $collection->foregin('attribute_ids')->references('id')->on('product_attributes')->onDelete('cascade');
            $collection->foregin('attributeValue_ids')->references('id')->on('product_attribute_values')->onDelete('cascade');
            
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
