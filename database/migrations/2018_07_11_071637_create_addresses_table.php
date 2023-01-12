<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('type',['shipping','billing'])->default('shipping');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->boolean('is_company')->default(0);
            $table->string('gst_no', 15)->nullable();
            $table->string('pan_no', 12)->nullable();
            $table->string('tin_no')->nullable();
            $table->string('address_line_0', 30);
            $table->string('address_line_1', 30);
            $table->string('address_line_2', 30)->nullable();
            $table->string('city');
            $table->string('pincode', 6);
            $table->string('state');
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
        Schema::dropIfExists('addresses');
    }
}
