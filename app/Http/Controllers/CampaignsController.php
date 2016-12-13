<?php
/**
 *
 *  顧客用ページ
 *      ・キャンペーン一覧ページ
 *      ・キャンペーン詳細ページ
 *
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Campaign;
use Illuminate\Support\Facades\DB;

class CampaignsController extends Controller
{
    //  キャンペーン一覧ページ
    public function index() {
      $today = Carbon::now();
      $campaigns = DB::table('campaigns_master')->where('campaign_start_day','<=',$today)->where('campaign_end_day','>=',$today)->orWhere('campaign_end_day','=',null)->get();
      return view('topic.index',compact('campaigns'));
    }

    //  キャンペーン詳細ページ
    public function campaignDetail(Request $request) {
      $id = $request->get("id");
      $campaign = DB::table('campaigns_master')->where('id', $id)->first();
      return view('topic.detail',compact('campaign'));
    }
}
