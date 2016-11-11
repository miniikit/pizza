<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeesMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('employees_master', function (Blueprint $table) {
        $table->increments('id');//->primary(); //従業員ID
        $table->string('emoloyee_name'); //従業員氏名
        $table->string('emoloyee_kana'); //従業員カナ
        $table->date('emoloyee_birth'); //生年月日
        $table->integer('gender_id');//->references('id')->on('gender_master'); //性別ID
        $table->date('emoloyee_agreement_date'); //契約開始日
        $table->date('emoloyee_agreement_enddate')->nullable(); //契約終了日
        $table->string('emoloyee_address1'); //住所1
        $table->string('emoloyee_address2'); //住所2
        $table->string('emoloyee_address3')->nullable(); //住所3
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
      Schema::dropIfExists('employees_master');
    }
}
