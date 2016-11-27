<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemporariesUsersMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('temporaries_users_master', function (Blueprint $table) {
        $table->increments('id');//->primary(); //一時会員ID
        $table->string('temporary_user_name'); //氏名
        $table->string('temporary_user_kana'); //カナ
        $table->integer('temporary_user_postal'); //郵便番号
        $table->string('temporary_user_address1'); //住所1
        $table->string('temporary_user_address2'); //住所2
        $table->string('temporary_user_address3')->nullable(); //住所3
        $table->integer('temporary_user_tel'); //電話番号
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
      Schema::dropIfExists('temporaries_users_master');
    }
}
