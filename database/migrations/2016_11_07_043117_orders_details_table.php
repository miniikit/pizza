<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders_details_master', function (Blueprint $table) {
        $table->integer('order_detail_id')->primary(); //注文明細ID
        $table->integer('product_id')->references('id')->on('products_master'); //商品ID
        $table->integer('number'); //数量
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
      Schema::dropIfExists('orders_details_master');
    }
}
