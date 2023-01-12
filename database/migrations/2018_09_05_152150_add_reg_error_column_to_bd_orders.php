<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegErrorColumnToBdOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blue_dart_orders', function(Blueprint $table){
            $table->text('reg_error')->after('expected_delivery_date')
                                    ->nullable()
                                    ->comment('Logs error of bd registration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blue_dart_orders', function(Blueprint $table){
            $table->dropColumn('reg_error');
        });
    }
}
