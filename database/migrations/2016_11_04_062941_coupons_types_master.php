<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CouponsTypesMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     // set seeder
     public function up()
     {
       Schema::create('coupons_types_master', function (Blueprint $table) {
           $table->increments('id'); //クーポン種別ID
           $table->string('coupon_type'); //クーポン種別
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
        Schema::dropIfExists('coupons_types_master');
    }
}
