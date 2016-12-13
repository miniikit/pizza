<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampaignsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('campaigns_master', function (Blueprint $table) {
          $table->increments('id');//->primary();  //キャンペーンID
          $table->string('campaign_title'); //キャンペーンタイトル
          $table->string('campaign_banner',50); //キャンペーンバナー
          $table->string('campaign_image',50); //キャンペーン画像
          $table->text('campaign_text');  //キャンペーン内容文
          $table->text('campaign_note');  //キャンペーン注意事項
          $table->string('campaign_subject')->nullable(); //キャンペーン対象者
          $table->dateTime('campaign_start_day'); //キャンペーン開始日
          $table->dateTime('campaign_end_day')->nullable(); //キャンペーン終了日
          $table->timestamps(); //登録日時・更新日時
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns_master');
    }
}
