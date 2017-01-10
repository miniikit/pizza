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


        // 人気商品を抽出

        $subMonth = Carbon::today()->subMonth();

        // 1.orderマスタ等から、注文情報を取得
        $populars = DB::table('orders_master')
            ->join('orders_details_table','orders_master.id','=','orders_details_table.id')
            ->join('products_prices_master','orders_details_table.price_id','=','products_prices_master.id')
            ->join('products_master','products_master.id','=','products_prices_master.product_id')
            // 現在販売期間中である商品のみで絞り込み
            ->where(function($query){$query->where('products_master.sales_end_date','>=',Carbon::today())->orWhere('products_master.sales_end_date','=',null);})
            // 集計に利用する期間
            ->where('order_date','>=',$subMonth)
            // 集計対象をピザのみに
            ->where('products_master.genre_id','=',1)
            ->get();

        // 2.取得した注文情報から、「価格ID : その商品の注文回数」の形式でまとめる
        $count = array();
        foreach($populars as $popular){
            if(!isset($count[$popular->price_id])){
                $count[$popular->price_id] = 0;
            }
            $count[$popular->price_id] += 1;
        }

        // 連想配列 valueの降順にソート
        arsort($count);

        // ソートした値を、連想配列 keyのみに。（価格IDのみに）
        $price_id  =array_keys($count);

        // DBから商品情報・価格情報を取得
        $populars = array();
        for($i =0; $i<3; $i++){
            $populars[$i] = DB::table('products_master')->join('products_prices_master','products_master.id','=','products_prices_master.product_id')->where('products_prices_master.id','=',$price_id[$i])->first();
        }


        return view('index',compact('campaigns','populars'));
    }

}
