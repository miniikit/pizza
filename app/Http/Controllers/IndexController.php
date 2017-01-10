<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Campaign;
use Illuminate\Support\Facades\DB;
use App\Service\RankingService;


class IndexController extends Controller
{

    protected $rankingService;

    public function __construct(RankingService $rankingService)
    {
        $this->rankingService = $rankingService;
    }

    public function index(){
        $today = Carbon::today();
        $campaigns = DB::table('campaigns_master')->where('campaign_start_day','<=',$today)->where('campaign_end_day','>=',$today)->orWhere('campaign_end_day','=',null)->get();

        $subMonth = Carbon::today()->subMonth();

        $popularPizza =  $this->rankingService->popular($subMonth,1,3);
        $popularSide = $this->rankingService->popular($subMonth,2,3);
        $popularDrink = $this->rankingService->popular($subMonth,3,3);


        return view('index',compact('campaigns','popularPizza','popularSide','popularDrink'));
    }

}
