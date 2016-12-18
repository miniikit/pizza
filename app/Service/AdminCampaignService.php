<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;


class AdminCampaignService
{
    public function getAll()
    {

        $campaigns = DB::table('campaigns_master')->get();

        return $campaigns;
    }

    public function getOne($id)
    {

        $campaign = DB::table('campaigns_master')->where('id', '=', $id)->first();

        return $campaign;
    }

    public function update($request, $id)
    {

        $nowData = DB::table('campaigns_master')->where('id', '=', $id)->first();

        $update = array();

        $update['campaign_title'] = $request->campaign_name;
        $update['campaign_text'] = $request->campaign_text;
        $update['campaign_note'] = $request->campaign_note;
        $tmp_subject = $request->campaign_subject;
        if ($tmp_subject == 1) {
            $insert["campaign_subject"] = "全会員";
        } else if ($tmp_subject == 2) {
            $insert["campaign_subject"] = "初回利用者限定";
        } else {
            $insert["campaign_subject"] = "全員";
        }
        $update['campaign_end_day'] = $request->campaign_end_day;
        if (isset($request->file1)) {
            $update['campaign_image'] = $request->file1;
        } else {
            $update['campaign_image'] = $nowData->campaign_image;
        }
        if (isset($request->file2)) {
            $update['campaign_banner'] = $request->file2;
        } else {
            $update['campaign_banner'] = $nowData->campaign_banner;
        }

        $status = DB::table('campaigns_master')->where('id', '=', $id)->update($update);

        return $status;
    }

    public function insert($request)
    {
        $insert = array();

        $insert["campaign_title"] = $request->campaign_name;
        $insert["campaign_text"] = $request->campaign_text;
        $insert["campaign_note"] = $request->campaign_note;
        $tmp_subject = $request->campaign_subject;
        if ($tmp_subject == 1) {
            $insert["campaign_subject"] = "全会員";
        } else if ($tmp_subject == 2) {
            $insert["campaign_subject"] = "初回利用者限定";
        } else {
            $insert["campaign_subject"] = "全員";
        }
        $insert["campaign_start_day"] = $request->campaign_start_day;
        $insert["campaign_end_day"] = $request->campaign_end_day;
        $insert["campaign_image"] = $request->file1;
        $insert["campaign_banner"] = $request->file2;

        $id = DB::table('campaigns_master')->insertGetId($insert);

        return $id;
    }
}