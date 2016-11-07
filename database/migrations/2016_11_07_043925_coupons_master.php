<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CouponsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('coupons_master', function (Blueprint $table) {
        $table->integer('coupon_id')->primary(); //クーポンID
        $table->string('coupon_name'); //クーポン名
        $table->integer('coupon_discount'); //クーポン値引き額
        $table->integer('coupon_conditions_money'); //使用金額条件
        $table->integer('product_id')->references('id')->on('products_master'); //商品ID
        $table->date('coupon_start_date'); //クーポン開始日
        $table->date('coupon_end_date')->nullable(); //クーポン終了日
        $table->integer('coupon_number'); //クーポン番号
        $table->integer('coupon_conditions_count')->nullable(); //クーポン使用条件回数
        $table->integer('coupon_conditions_first')->nullable(); //クーポン使用条件初回
        $table->timestamps(); //登録・更新日
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('coupons_master');
    }
}
