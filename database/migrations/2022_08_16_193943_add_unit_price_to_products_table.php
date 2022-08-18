<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitPriceToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('depth')->nullable();
            $table->double('weight')->nullable();
            $table->index('width_measuring_unit_option_value_id');
            $table->index('height_measuring_unit_option_value_id');
            $table->index('depth_measuring_unit_option_value_id');
            $table->index('weight_measuring_unit_option_value_id');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->double('unit_special_price');
            $table->datetime('unit_special_price_from');
            $table->datetime('unit_special_price_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
