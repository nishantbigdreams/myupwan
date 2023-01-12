<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedDestCodeDestLocToBDOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blue_dart_orders', function (Blueprint $table) {
            $table->string('CCRCRDREF')->after('awb_pdf')->nullable();
            $table->string('dest_area')->after('CCRCRDREF')->nullable();
            $table->string('dest_loc')->after('dest_area')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blue_dart_orders', function (Blueprint $table) {
            $table->dropColumn(['CCRCRDREF', 'dest_area', 'dest_loc']);
        });
    }
}
