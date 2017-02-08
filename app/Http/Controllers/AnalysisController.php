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

    // 売れ筋商品
    public function index_popular()
    {
        // デフォルトで表示するもの
        $period_start_day = Carbon::today()->subMonth();
        $period_end_day = Carbon::today();
        $member_type = 0; // 全会員
        $target_genre = 0; // 対象ジャンル

        $AnalysisService = new AnalysisService();
        $populars = $AnalysisService->popular($period_start_day,$period_end_day,$member_type,$target_genre);

        return view('pizzzzza.analysis.popular',compact('populars'));
    }

    // 売れ筋商品>>条件適用時向け
    public function popular_ajax(Request $request)
    {
        $RankingService = new RankingService();
        $ranking = $RankingService->popular($request["period_start_day"],$request["period_end_day"],$request["needNum"],$request["member_type"]);

    }

    public function old_index_popular(){
        $period_start_day = Carbon::yesterday();
        $period_end_day = Carbon::today();
        $member_type = 3;

        $products = $this->analysisService->popular($period_start_day,$period_end_day,$member_type);

        return view('pizzzzza.analysis.popular',compact('products'));
    }


    public function index_earning() {
        return view('pizzzzza.analysis.earning');
    }


}
