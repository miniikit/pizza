<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;


class AdminCampaignService
{
    public function insert($request){

        //
        //  POSTデータの受け取り
        //

            $campaign_name = $request->campaign_name;
            $campaign_text = $request->campaign_text;
            $campaign_note = $request->campaign_note;
            $tmp_campaign_subject = $request->campaign_subject;
            if($tmp_campaign_subject == 1){
                $campaign_subject = "全会員";
            }else if($tmp_campaign_subject == 2){
                $campaign_subject = "初回利用者限定";
            }else{
                $campaign_subject = "全員";
            }
            $campaign_start_day = $request->campaign_start_day;
            $campaign_end_day = $request->campaign_end_day;
            $campaign_image_main = $request->file1;
            $campaign_image_banner = $request->file2;

        //
        //  DBにInsert
        //
            $id = DB::table('campaigns_master')->insertGetId([""]);


            dd($request->all());
        return 'a';
    }
}