<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminCampaignService
{
    // すべて
    public function getAll()
    {
        $campaigns = DB::table('campaigns_master')->get();

        return $campaigns;
    }

    // 開催中のみ
    public function getNowAll()
    {
        $today = Carbon::today();

        $campaigns = DB::table('campaigns_master')->where('campaign_start_day','<=',$today)->where('campaign_end_day','>=',$today)->orWhere('campaign_end_day','=',null)->where('deleted_at','=',null)->get();

        return $campaigns;
    }

    // $idが一致する１件
    public function getOne($id)
    {
        $campaign = DB::table('campaigns_master')->where('id', '=', $id)->first();

        return $campaign;
    }

    // 更新処理
    public function update($request, $id)
    {
        // 現在のDBのデータを取得（キャンペーン画像用）
        $nowData = DB::table('campaigns_master')->where('id', '=', $id)->first();

        $update = array();
        $carbon = Carbon::now();

        //
        // 更新データのセット
        //

            $update['campaign_title'] = $request->campaign_name;
            $update['campaign_text'] = $request->campaign_text;
            $update['campaign_note'] = $request->campaign_note;
            $update['campaign_end_day'] = $request->campaign_end_day;

            // 対象者を、数値からDB格納用に変換
            $tmp_subject = $request->campaign_subject;
            if ($tmp_subject == 1) {
                $update["campaign_subject"] = "全会員";
            } else if ($tmp_subject == 2) {
                $update["campaign_subject"] = "初回利用者限定";
            } else {
                $update["campaign_subject"] = "全員";
            }

            //キャンペーン画像
            if (isset($request->file1)) {
                // 画像１：名前を決めて画像を所定の場所に格納
                $file1 = $request->file('file1');
                $fileName1 = $carbon->format('Y-m-d-H-i-s') . '.jpg';
                $file1->move(public_path('images/campaign/'), $fileName1);
                $update['campaign_image'] = '/images/campaign/' . $fileName1;
            } else {
                $update['campaign_image'] = $nowData->campaign_image;
            }

            //キャンペーンバナー
            if (isset($request->file2)) {
                // 画像２：名前を決めて画像を所定の場所に格納
                $file2 = $request->file('file2');
                $fileName2 = $carbon->format('Y-m-d-H-i-s') . '.jpg';
                $file2->move(public_path('images/campaign_banner/'), $fileName2);
                $update['campaign_banner'] = '/images/campaign_banner/' . $fileName2;
            } else {
                $update['campaign_banner'] = $nowData->campaign_banner;
            }

        // Update SQL
        $status = DB::table('campaigns_master')->where('id', '=', $id)->update($update);

        return $status;
    }

    // 追加処理
    public function insert($request)
    {
        $carbon = Carbon::now();

        // 画像１：名前を決めて画像を所定の場所に格納
        $file1 = $request->file('file1');
        $fileName1 = $carbon->format('Y-m-d-H-i-s') . '.jpg';
        $file1->move(public_path('images/campaign/'), $fileName1);

        // 画像２：名前を決めて画像を所定の場所に格納
        $file2 = $request->file('file2');
        $fileName2 = $carbon->format('Y-m-d-H-i-s') . '.jpg';
        $file2->move(public_path('images/campaign_banner/'), $fileName2);

        $insert = array();

        //POSTデータを挿入用配列にセット
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
        $insert["campaign_image"] = '/images/campaign/' . $fileName1;
        $insert["campaign_banner"] = '/images/campaign_banner/' . $fileName2;


        $id = DB::table('campaigns_master')->insertGetId($insert);

        return $id;
    }

    // 削除処理
    public function delete($id){

        $now = Carbon::now();
        $yesterday = Carbon::yesterday();

        $delete = DB::table('campaigns_master')->where('id','=',$id)->update(["deleted_at" => $now,"campaign_end_day" => $yesterday]);

        return $delete;
    }
}