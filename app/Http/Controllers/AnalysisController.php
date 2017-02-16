<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;


use App\Service\AnalysisService;
use App\Service\RankingService;


class AnalysisController extends Controller
{

    protected $analysisService;


    public function __construct(AnalysisService $analysisService)
    {
        $this->analysisService = $analysisService;
    }


    // 人気商品管理
    public function index_popular()
    {
        // デフォルトで表示するもの
        $period_start_day = Carbon::today()->subMonth();
        $period_end_day = Carbon::now();
        $member_type = 0; // 全会員
        $target_genre = 0; // 対象ジャンル
        $member_gender = 0; // 性別
        $older_min_date = Carbon::create(1000, 1, 1, 0, 0, 0, 'Asia/Tokyo'); // 年代指定なし
        $older_max_date = Carbon::create(1000, 4, 1, 0, 0, 0, 'Asia/Tokyo'); // 年代指定なし

        $AnalysisService = new AnalysisService();
        $populars = $AnalysisService->popular($period_start_day,$period_end_day,$member_type,$target_genre,$member_gender,$older_min_date,$older_max_date);

        return view('pizzzzza.analysis.popular',compact('populars'));
    }


    // 人気商品管理>>条件適用時向け(ajax)
    public function apply_popular(Request $request)
    {
        $now = Carbon::now();

        /*
         *   入力値チェック・変換
         */

        // エラー返却用
        $errors = array();

        // 開始日と終了日>>期間を指定された場合
        if($request["period"] === "check") {

            // 日付がnull
            if(is_null($request["start_date"]) || is_null($request["end_date"])){
                //err
                $errors["error"] = "日付が入力されていません。";
                return $errors;
            }

            // 日付が不正 >> 未来、開始日と終了日が逆の場合
            if($now <= $request["start_date"] || $request["start_date"] >= $request["end_date"]){
                //err
                $errors["error"] = "日付が不正です。";
                return $errors;
            }

            // 開始日
            list($Y, $m, $d) = explode('-', $request["start_date"]);
            if (checkdate($m, $d, $Y) && $request["start_date"] <= $now) {
                $period_start_day = $request["start_date"];
            } else {
                $period_start_day = Carbon::today()->subMonth();
            }

            // 終了日
            list($Y, $m, $d) = explode('-', $request["end_date"]);
            if (checkdate($m, $d, $Y) && $request["end_date"] >= $period_start_day) {
                $period_end_day = $request["end_date"];
            } else {
                $period_end_day = $now;
            }

        // 期間が指定されなかった場合
        } else {
            $period_start_day = Carbon::today()->subMonth();
            $period_end_day = $now;
        }

        // 会員種別
        if($request["member_type"] === "web"){
            $member_type = 3; // 電話
        } else if($request["member_type"] === "phone"){
            $member_type = 4; // ウェブ
        } else {
            $member_type = 0;
        }

        // 性別
        if($request["gender"] === "man"){
            $member_gender = 1; // 男性
        } else if($request["gender"] === "woman"){
            $member_gender = 2; // 女性
        } else {
            $member_gender = 0; // 指定なし
        }

        // ジャンル
        if($request["genre"] === "pizza"){
            $target_genre = 1; // ピザ
        } else if($request["genre"] === "side"){
            $target_genre = 2; // サイド
        } else if($request["genre"] === "drink"){
            $target_genre = 3; // ドリンク
        } else {
            $target_genre = 0; // 指定なし
        }

        // 年代
        $this_month = Carbon::today()->month;
        // 年代 >> ベース日時の設定
        $this_year = Carbon::today()->year; // 今年
        if($this_month >= 4){
            $next_year = $this_year + 1;
            $first_day = Carbon::create($this_year, 4, 1, 0, 0, 0, 'Asia/Tokyo'); // XXXX年 4月1日 0時0分
            $last_day = Carbon::create($next_year, 4, 1, 0, 0, 0, 'Asia/Tokyo')->subMinute(1); // XXXX年 3月31日 23時59分
        } else {
            $last_year = $this_year - 1; // 去年
            $first_day = Carbon::create($last_year, 4, 1, 0, 0, 0, 'Asia/Tokyo'); // XXXX年 4月1日 0時0分
            $last_day = Carbon::create($this_year, 4, 1, 0, 0, 0, 'Asia/Tokyo')->subMinute(1); // XXXX年 3月31日 23時59分
        }

        // 年代 >> チェック
        if($request["older"] === "10"){ // 0歳〜19歳
            $older_min_date = $first_day->subYear(19);
            $older_max_date = $last_day;
        } else if($request["older"] === "20"){ // 20歳〜29歳
            $older_min_date = $first_day->subYear(29);
            $older_max_date = $last_day->subYear(20);
        } else if($request["older"] === "30"){ // 30歳〜39歳
            $older_min_date = $first_day->subYear(39);
            $older_max_date = $last_day->subYear(30);
        } else if($request["older"] === "40"){ // 40歳〜49歳
            $older_min_date = $first_day->subYear(49);
            $older_max_date = $last_day->subYear(40);
        } else if($request["older"] === "50"){ // 50歳〜59歳
            $older_min_date = $first_day->subYear(59);
            $older_max_date = $last_day->subYear(50);
        } else if($request["older"] === "60"){ // 60歳〜
            $older_min_date = $first_day->subYear(999);
            $older_max_date = $last_day->subYear(60);
        } else{ // 指定なしの場合
            $older_min_date = Carbon::create(1000, 1, 1, 0, 0, 0, 'Asia/Tokyo');
            $older_max_date = Carbon::create(1000, 4, 1, 0, 0, 0, 'Asia/Tokyo');
        }


        $AnalysisService = new AnalysisService();
        $populars = $AnalysisService->popular($period_start_day,$period_end_day,$member_type,$target_genre,$member_gender,$older_min_date,$older_max_date);
        // JSでの処理短縮用
        if($populars) {
            $populars["check_flg"] = 1;
        } else { // 条件合致なしの場合など。
            $populars["check_flg"] = 0;
        }
        return $populars;
    }
    public function old_index_popular(){
        // デフォルトで表示するもの
        $period_start_day = Carbon::today()->subMonth();
        $period_end_day = Carbon::now();
        $member_type = 0; // 全会員
        $target_genre = 0; // 対象ジャンル
        $member_gender = 0; // 性別
        $older_min_date = Carbon::create(1000, 1, 1, 0, 0, 0, 'Asia/Tokyo'); // 年代指定なし
        $older_max_date = Carbon::create(1000, 4, 1, 0, 0, 0, 'Asia/Tokyo'); // 年代指定なし

        $AnalysisService = new AnalysisService();
        $populars = $AnalysisService->popular($period_start_day,$period_end_day,$member_type,$target_genre,$member_gender,$older_min_date,$older_max_date);

        return view('pizzzzza.analysis.popular',compact('populars'));
    }

    // 売上管理
    public function index_earning()
    {
        // デフォルトで表示するもの
        $start_day = Carbon::today()->subYear();
        $end_day = Carbon::now();
        $order_type = 0; // 注文種別
        $period_type = 0; // 期間種別 ( 週:0 / 月:1 / 年:2 )

        // 売上高 グラフ用
        $AnalysisService = new AnalysisService();
        $earning = $AnalysisService->earning($start_day,$end_day,$order_type,$period_type);

        // 商品ごとの統計用
        // デフォルトで表示するもの
        $member_type = 0; // 全会員
        $target_genre = 0; // 対象ジャンル
        $member_gender = 0; // 性別
        $older_min_date = Carbon::create(1000, 1, 1, 0, 0, 0, 'Asia/Tokyo'); // 年代指定なし
        $older_max_date = Carbon::create(1000, 4, 1, 0, 0, 0, 'Asia/Tokyo'); // 年代指定なし

        $AnalysisService = new AnalysisService();
        $populars = $AnalysisService->popular($start_day,$end_day,$member_type,$target_genre,$member_gender,$older_min_date,$older_max_date);


        return view('pizzzzza.analysis.earning',compact('earning','populars'));
    }


}
