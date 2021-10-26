<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_translation', function (Blueprint $table) {
            $table->id();
            $table->index('category_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            
            $table->foregin('category_id')->references('id')->on('categories')->onDelete('cascade'); // in docs its not covered how to connect this or I missed something and used just like for relational db
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_translation');
    }
}
