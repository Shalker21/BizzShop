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
            $collection->index('variation_ids');
            $collection->string('code');
            $collection->boolean('enabled')->default(0);

            $collection->foregin('category_ids')->references('id')->on('categories')->onDelete('cascade');
            $collection->foregin('variation_ids')->references('id')->on('product_variants')->onDelete('cascade');
            
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
