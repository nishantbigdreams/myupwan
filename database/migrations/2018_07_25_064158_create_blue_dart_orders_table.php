<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlueDartOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blue_dart_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('token')->nullable();
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->string('reference_no')->nullable();
            $table->text('remark')->nullable();
            $table->string('awb_no')->nullable();
            $table->mediumText('awb_pdf')->nullable();
            $table->string('received_by')->nullable();
            $table->date('expected_delivery_date')->nullable();
            $table->timestamp('registered_at')->nullable();
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
        Schema::dropIfExists('blue_dart_orders');
    }
}
