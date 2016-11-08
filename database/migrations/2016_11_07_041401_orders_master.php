<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders_master', function (Blueprint $table) {
        $table->integer('order_id')->primary(); //注文ID
        $table->datetime('order_date'); //注文日時
        $table->datetime('order_appointment_date'); //注文予約日時
        $table->integer('coupon_id')->references('id')->on('coupons_master')->nullable(); //クーポンID
        $table->integer('state_id')->references('id')->on('states_master'); //状態ID
        $table->timestamps(); //登録・更新日
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('orders_master');
    }
}
