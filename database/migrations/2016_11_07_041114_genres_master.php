<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenresMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     // set seeder
    public function up()
    {
      Schema::create('genres_master', function (Blueprint $table) {
        $table->increments('id'); //ジャンルID
        $table->string('genre_name'); //ジャンル名
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
        Schema::dropIfExists('genres_master');
    }
}
