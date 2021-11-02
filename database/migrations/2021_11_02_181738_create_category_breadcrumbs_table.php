<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryBreadcrumbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_breadcrumbs', function (Blueprint $table) {
            $table->id();
            $table->index('breadcrumb_id');
            $table->string('breadcrumb');
            
            $table->foregin('breadcrumb_id')->references('id')->on('categories')->onDelete('cascade'); // in docs its not covered how to connect this or I missed something and used just like for relational db
    
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
        Schema::dropIfExists('category_breadcrumbs');
    }
}
