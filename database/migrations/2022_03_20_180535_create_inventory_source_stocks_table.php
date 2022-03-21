<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorySourceStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_source_stocks', function (Blueprint $table) {
            $table->id();

            $table->index('product_id');
            $table->index('variant_id');
            $table->index('inventory_id');
            $table->string('code');
            $table->string('stock');

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
        Schema::dropIfExists('inventory_source_stocks');
    }
}
