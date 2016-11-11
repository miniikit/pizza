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
        $table->integer('users_id');//->references('id')->on('users'); //会員ID
        $table->date('emoloyee_agreement_date'); //契約開始日
        $table->date('emoloyee_agreement_enddate')->nullable(); //契約終了日
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
