<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsPricesMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('products_prices_master', function (Blueprint $table) {
        $table->integer('product_price_id')->primary(); //価格ID
        $table->integer('product_id')->references('id')->on('products_master'); //商品ID
        $table->integer('product_price'); //商品価格
        $table->date('price_change_startdate'); //価格変更開始日
        $table->date('price_change_enddate')->nullable(); //価格変更終了日
        $table->integer('employee_id')->references('id')->on('employees_master'); //従業員ID
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
      Schema::dropIfExists('products_prices_master');
    }
}
