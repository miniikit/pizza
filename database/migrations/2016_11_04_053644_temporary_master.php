<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemporaryMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('temporaries_members_master', function (Blueprint $table) {
        $table->integer('temporary_member_id')->primary();
        $table->string('temporary_member_name');
        $table->string('temporary_member_kana');
        $table->integer('temporary_member_postel');
        $table->string('temporary_member_address1');
        $table->string('temporary_member_address2');
        $table->string('temporary_member_address3')->nullable();
        $table->integer('temporary_member_tel');
        $table->timestamps();
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
