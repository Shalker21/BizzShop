<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantStockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variant_stock_items', function (Blueprint $table) {
            $table->id();

            $table->index('variant_id');
            $table->index('product_id');
            $table->index('selected_product_id');
            $table->index('width_measuring_unit_option_value_id');
            $table->index('height_measuring_unit_option_value_id');
            $table->index('depth_measuring_unit_option_value_id');
            $table->index('weight_measuring_unit_option_value_id');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->double('unit_special_price');
            $table->datetime('unit_special_price_from');
            $table->datetime('unit_special_price_to');
            
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
        Schema::dropIfExists('product_variant_stock_items');
    }
}
