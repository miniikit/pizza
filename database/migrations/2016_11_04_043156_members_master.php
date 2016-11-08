<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembersMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('members_master', function (Blueprint $table) {
        $table->increments('member_id');//->primary(); //会員ID
        $table->string('member_password'); //パスワード
        $table->string('member_mail')->unique(); //メールアドレス
        $table->string('member_name'); //氏名
        $table->string('member_kana'); //カナ
        $table->string('member_postel'); //郵便番号
        $table->string('member_address1'); //住所1
        $table->string('member_address2'); //住所2
        $table->string('member_address3')->nullable(); //住所3
        $table->integer('member_tel'); //電話番号
        $table->integer('gender_id');//->references('id')->on('gender_master'); //性別ID
        $table->integer('member_birth'); //生年月日
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
      Schema::dropIfExists('members_master');
    }
}
