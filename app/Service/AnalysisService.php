<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AnalysisService
{

    // 売れ筋商品を検索
    public function popular($period_start_day,$period_end_day,$member_type,$target_genre){
        //
        //

        // ジャンル
        if($target_genre >= 1){
            $target_genre_status = true;
        } else {
            $target_genre_status = false;
        }
        // 会員種別
        if($member_type >= 1){
            $member_type_status = true;
        } else {
            $member_type_status = false;
        }

        // 注文情報
        $orders = DB::table('orders_master')
            ->join('orders_details_table','orders_master.id','=','orders_details_table.id')
            ->join('users','users.id','=','orders_master.user_id')
            ->join('products_prices_master', 'orders_details_table.price_id', '=', 'products_prices_master.id')
            ->join('products_master', 'products_master.id', '=', 'products_prices_master.product_id')
            // 期間
            ->whereBetween('orders_master.order_appointment_date',[$period_start_day,$period_end_day])
            // ジャンルの指定があれば
            ->when($target_genre_status, function ($query) use ($target_genre) {
                return $query->where('products_master.genre_id', '=', $target_genre);
            })
            // 会員種別の指定があれば
            ->when($member_type_status, function ($query) use ($member_type) {
                return $query->where('users.authority_id','=',$member_type);
            })
            ->get();
        $order_count = count($orders);

        // 取得した注文情報から、「価格ID : その商品の注文回数」の形式でまとめる
        $popular_count = array();
        $max = 0;
        foreach ($orders as $order) {
            if (!isset($popular_count[$order->price_id])) {
                $popular_count[$order->price_id] = 0;
            }
            $popular_count[$order->price_id] += 1;

            if($popular_count[$order->price_id] > $max){
                $max = $popular_count[$order->price_id];
            }
        }
        // value（売上数）の降順にソート
        arsort($popular_count);

        // 人気商品を、価格IDと商品情報と保存。
        // 出力 : $populars[0] => array("price_id" => 1 "product_info" => {+"id" : 9 "product_name:"name" ...})
        $populars = array();
        $i = 0;
        foreach(array_keys($popular_count) as $key){
            $populars[$i]['product_info'] = DB::table('products_master')->join('products_prices_master', 'products_master.id', '=', 'products_prices_master.product_id')->where('products_prices_master.id', '=', $key)->first();
            $populars[$i]['number_of_sales'] = $popular_count[$key]; // 売上数
            $populars[$i]['share'] = round($popular_count[$key] / $order_count,3) * 100; // シェア率
            $i++;
        }

        return $populars;
    }



}