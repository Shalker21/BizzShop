<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function ($collection) {
            $collection->id();
            $collection->index('product_id');
            $collection->string('name');
            $collection->index('slug');
            $collection->text('description');
            $collection->string('short_description');
            $collection->string('meta_keywords');
            $collection->string('meta_description');

            $collection->foregin('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('product_translations');
    }
}
