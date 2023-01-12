<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->enum('is_paid',['yes','no'])->default('no');
            $table->enum('status',['processing','confirm','packed','in_transit','cancelled','return','registered','delivered','Redirected', 'Undelivered','out_for_delivery'])
                ->default('processing');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('address_line_0');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('pincode', 6);
            $table->string('state');
            $table->mediumText('product_id');
            $table->mediumText('product_sku');
            $table->mediumText('product_qty');
            $table->mediumText('product_name');
            $table->mediumText('product_price');
            $table->mediumText('product_image');
            $table->double('order_price');
            $table->double('gst');
            $table->double('total');
            $table->double('discount')->nullable()->comment('used for neft payment discount');
            $table->double('bulk_purchase_discount')->default(0);
            $table->string('discount_reason')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('cancelled_at')->nullable();
            $table->text('cancelled_reason')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
