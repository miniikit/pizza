<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('products_master', function (Blueprint $table) {
        $table->integer('product_id')->primary(); //商品ID
        $table->string('product_name'); //商品名
        $table->integer('price_id')->references('id')->on('products_prices_master'); //価格ID
        $table->string('product_image'); //商品画像
        $table->string('product_text'); //商品説明文
        $table->integer('genre_id')->references('id')->on('genres_master'); //ジャンルID
        $table->date('sales_start_date'); //販売開始日
        $table->date('sales_end_date')->nullable(); //販売終了日
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
      Schema::dropIfExists('products_master');
    }
}
