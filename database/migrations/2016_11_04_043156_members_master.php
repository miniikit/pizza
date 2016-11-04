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
        $table->integer('member_id')->primary();
        $table->string('member_mail')->unique();
        $table->string('member_name');
        $table->string('member_kana');
        $table->string('member_postel');
        $table->string('member_address1');
        $table->string('member_address2');
        $table->string('member_address3')->nullable();
        $table->integer('member_tel');
        $table->integer('gender_id')->references('id')->on('gender_master');
        $table->integer('member_birth');
        $table->timestamps();
        $table->string('member_password');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
