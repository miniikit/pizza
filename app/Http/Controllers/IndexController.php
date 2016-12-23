<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Campaign;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
      $today = Carbon::today();
      $campaigns = DB::table('campaigns_master')->where('campaign_start_day','<=',$today)->where('campaign_end_day','>=',$today)->orWhere('campaign_end_day','=',null)->get();
      return view('index',compact('campaigns'));
    }

}
