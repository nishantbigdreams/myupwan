<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->text('reason')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('bank')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->date('return_order_pickup_date')->nullable();
            $table->string('pickup_time')->nullable();
            $table->string('status')->nullable();
            $table->text('remark')->nullable();
            $table->boolean('is_refunded')->nullable();
            $table->string('mode_of_refund')->nullable();
            $table->double('refund_amount')->nullable();
            $table->date('refund_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('return_orders');
    }
}
