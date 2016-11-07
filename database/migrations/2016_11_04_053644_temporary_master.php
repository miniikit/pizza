<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemporariesMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('temporaries_members_master', function (Blueprint $table) {
        $table->integer('temporary_member_id')->primary(); //一時会員ID
        $table->string('temporary_member_name'); //氏名
        $table->string('temporary_member_kana');　//カナ
        $table->integer('temporary_member_postel'); //郵便番号
        $table->string('temporary_member_address1');　//住所1
        $table->string('temporary_member_address2');　//住所2
        $table->string('temporary_member_address3')->nullable();　//住所3
        $table->integer('temporary_member_tel'); //電話番号
        $table->timestamps(); //登録・更新
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('temporaries_members_master');
    }
}
