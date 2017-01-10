<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RankingService
{

    // ジャンルごとの、3つの人気商品情報を返却。
    // $period : 対象期間。例：Carbon::today()->subMonth();
    // $targetGenre : 対象とするジャンルID
    // $needNum : 必要とする結果の数
    public function popular($period, $targetGenre, $needNum)
    {

        // orderマスタ等から、注文情報を取得
        $orders = DB::table('orders_master')
            ->join('orders_details_table', 'orders_master.id', '=', 'orders_details_table.id')
            ->join('products_prices_master', 'orders_details_table.price_id', '=', 'products_prices_master.id')
            ->join('products_master', 'products_master.id', '=', 'products_prices_master.product_id')
            // 現在販売期間中である商品のみで絞り込み
            ->where(function ($query) {
                $query->where('products_master.sales_end_date', '>=', Carbon::today())
                    ->orWhere('products_master.sales_end_date', '=', null);
            })
            // 集計に利用する期間
            ->where('order_date', '>=', $period)
            ->where('products_master.genre_id', '=', $targetGenre)
            ->get();


        // 取得した注文情報から、「価格ID : その商品の注文回数」の形式でまとめる
        $count = array();
        foreach ($orders as $order) {
            if (!isset($count[$order->price_id])) {
                $count[$order->price_id] = 0;
            }
            $count[$order->price_id] += 1;
        }


        // 例外処理::引数で要求された個数より、ランキングに表示する件数が少ない場合 > そのジャンルの他の商品を設定
        if ($needNum > count($count)) {
            $needDataNum = $needNum - count($count);
            $products = DB::table('products_master')
                ->join('products_prices_master', 'products_prices_master.product_id', '=', 'products_master')
                ->where('products_master.genre_id', '=', $targetGenre)
                ->where('products_master.sales_start_date', '<=', Carbon::today())
                ->where(function ($query) {
                    $query->where('products_master.sales_end_date', '>=', Carbon::today())->orWhere('products_master.sales_end_date', '=', null);
                })
                ->get();
            for ($i = 0; $i < $needDataNum; $i++) {

                $judge = true;

                // key(価格ID)を連想配列に格納
                $keys = array_keys($count);

                for($j = 0; $j < count($products); $j++){
                    if($products[$i] === $keys[$j]){
                        $judge = false;
                        break;
                    }
                }

                if($judge === true){
                    array_push($count, $price_id, 0);
                }
            }

        }


        // 連想配列 valueの降順にソート
        arsort($count);

        // ソートした値を、連想配列 keyのみに。（価格IDのみに）
        $price_id = array_keys($count);

        // DBから商品情報・価格情報を取得
        $populars = array();
        for ($i = 0; $i < $needNum; $i++) {
            $populars[$i] = DB::table('products_master')->join('products_prices_master', 'products_master.id', '=', 'products_prices_master.product_id')->where('products_prices_master.id', '=', $price_id[$i])->first();
        }

        return $populars;

    }


}