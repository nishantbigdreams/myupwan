<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->string('model');
            $table->string('name');
            $table->string('category')->nullable();
            $table->mediumText('description');
            $table->mediumText('details');
            $table->string('status')->nullable();
            $table->float('in_stock')->default(0);
            $table->float('base_price')->nullable();
            $table->float('sell_price')->nullable();
            $table->float('gst')->default(0);
            $table->float('price_without_gst')->default(0);
            $table->string('similar_products')->nullable();
            $table->mediumText('data')->nullable();
            $table->text('combo_qty')->nullable();
            $table->text('combo_discount')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('parmanent_deleted_at')->nullable();
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
