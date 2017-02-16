<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AnalysisService
{
    /**
     * @param $period_start_day : 開始日
     * @param $period_end_day : 終了日
     * @param $member_type : 会員種別
     * @param $target_genre : 対象ジャンル
     * @param $member_gender : 性別
     * @param $older_min_date : 年代用の、日付
     * @param $older_max_date : 年代用の、日付
     * @return array
     */
    // 売れ筋商品を検索
    public function popular($period_start_day,$period_end_day,$member_type,$target_genre,$member_gender,$older_min_date,$older_max_date){
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
        // 性別
        if($member_gender >= 1){
            $member_gender_status = true;
        } else {
            $member_gender_status = false;
        }
        // 年代 ※指定なしの場合、呼び出し元関数側で、1000年1月1日が標準で設定されています。
        $check_date = Carbon::create(1300, 1, 1, 0, 0, 0, 'Asia/Tokyo');
        if($older_min_date >= $check_date || $older_max_date >= $check_date){
            $member_older_status = true;
        } else {
            $member_older_status = false;
        }

        // 注文情報
        $orders = DB::table('orders_master')
            ->join('orders_details_table','orders_master.id','=','orders_details_table.id')
            ->join('users','users.id','=','orders_master.user_id')
            ->join('products_prices_master', 'orders_details_table.price_id', '=', 'products_prices_master.id')
            ->join('products_master', 'products_master.id', '=', 'products_prices_master.product_id')
            // キャンセル除外は、ここでは行いません。最後にカウントします。
            //->where('orders_master.state_id','!=','3')
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
            // 性別の指定があれば
            ->when($member_gender_status, function ($query) use ($member_gender) {
                return $query->where('users.gender_id','=',$member_gender);
            })
            // 年代の指定があれば
            ->when($member_older_status, function ($query) use ($older_min_date,$older_max_date) {
                return $query->whereBetween('users.birthday',[$older_min_date,$older_max_date]);
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

        $base_query = DB::table('orders_master')
            ->join('orders_details_table','orders_master.id','=','orders_details_table.id')
            ->join('users','users.id','=','orders_master.user_id')
            ->join('products_prices_master', 'orders_details_table.price_id', '=', 'products_prices_master.id')
            ->join('products_master', 'products_master.id', '=', 'products_prices_master.product_id')
            // キャンセル除外は、ここでは行いません。最後にカウントします。
            //->where('orders_master.state_id','!=','3')
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
            // 性別の指定があれば
            ->when($member_gender_status, function ($query) use ($member_gender) {
                return $query->where('users.gender_id','=',$member_gender);
            })
            // 年代の指定があれば
            ->when($member_older_status, function ($query) use ($older_min_date,$older_max_date) {
                return $query->whereBetween('users.birthday',[$older_min_date,$older_max_date]);
            })
            ->select('orders_master.*');

        foreach(array_keys($popular_count) as $key){
            $populars[$i]['product_info'] = DB::table('products_master')->join('products_prices_master', 'products_master.id', '=', 'products_prices_master.product_id')->where('products_prices_master.id', '=', $key)->first();
            $populars[$i]['number_of_sales'] = $popular_count[$key]; // 売上数
            $populars[$i]['share'] = round($popular_count[$key] / $order_count,3) * 100; // シェア率
            // クーポン適用回数
            $coupon_count = DB::table('orders_master')
                ->whereNotNull('coupon_id')
                ->join('orders_details_table','orders_master.id','=','orders_details_table.id')
                ->where('orders_details_table.price_id','=',$key)
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
                // 性別の指定があれば
                ->when($member_gender_status, function ($query) use ($member_gender) {
                    return $query->where('users.gender_id','=',$member_gender);
                })
                // 年代の指定があれば
                ->when($member_older_status, function ($query) use ($older_min_date,$older_max_date) {
                    return $query->whereBetween('users.birthday',[$older_min_date,$older_max_date]);
                })
                ->count();
            $populars[$i]['coupon_count'] = $coupon_count;
            $populars[$i]['coupon_percentage'] = round($coupon_count / $popular_count[$key],3) * 100; // クーポン使用率

            $i++;
        }



        return $populars;
    }

    /**
     * @param $start_day : 開始日
     * @param $end_day : 終了日
     * @param $order_info : 注文種別(WEB/PHONE)
     * @param $period_type : 期間種別( 週:0 / 月:1 / 年:2 )
     */
    // 売上情報
    public function earning($start_day,$end_day,$order_info,$period_type){
        // 仕様 : 期間、注文種別(orders_masterのemployee_idがNULL = WEB)、期間種別
        // 表示項目 : キャンセル率、クーポン率、前年同期比

        // 注文種別
        if($order_info >= 1){
            $order_info_status = true;
        } else {
            $order_info_status = false;
        }

        // 注文情報
        $orders = DB::table('orders_master')
            ->join('orders_details_table','orders_master.id','=','orders_details_table.id')
            ->join('products_prices_master', 'orders_details_table.price_id', '=', 'products_prices_master.id')
            ->join('products_master', 'products_master.id', '=', 'products_prices_master.product_id')
            ->leftjoin('coupons_master','orders_master.coupon_id','coupons_master.id')
            // 期間
            ->whereBetween('orders_master.order_appointment_date',[$start_day,$end_day])
            // 注文種別の指定があれば
            ->when($order_info_status, function ($query) use ($order_info) {
                return $query->whereNull('orders.employee_id');
            })
            ->orderBy('orders_master.created_at','asc')
            ->get();

        $orders_count = count($orders);
        $orders_finish_count = 0; // 注文完了回数
        $cancel_count = 0; // 注文キャンセル回数
        $coupon_count = 0; // クーポン使用回数
        $coupon_amount = 0; // クーポン累計金額
        $sales_amount_total = 0; // 総売上高
        $sales_amount_real = 0; // 注文完了分の売上高
        $sales = array(); // 期間ごとの売上をまとめる


        // 日付(開始日・終了日)の差異を計算
        $start_day_unix = strtotime($start_day); // 日付をUNIXタイムスタンプに変換
        $end_day_unix = strtotime($end_day); // 日付をUNIXタイムスタンプに変換
        $seconddiff = abs($start_day_unix - $end_day_unix);  // 何秒離れているかを計算
        $daydiff = $seconddiff / (60 * 60 * 24);  // 日数に変換
        $unit = $daydiff / 4; // 期間の単位 100なら25、40なら10

        // 初期化
        $week = array("第一期","第二期","第三期","第四期");
        for($i = 0; $i < 4; $i++) {
            $sales[$i] = array();
            $sales[$i]["period_date"] = $week[$i];
            $sales[$i]["sales_amount"] = 0; // 売上高
        }

        // 四半期ごとにまとめる。
        foreach($orders as $order){
            $created_at = new Carbon($order->order_appointment_date);

            if($created_at->diffInDays($start_day) >= $unit * 3){
                $i = 3;
            } else if($created_at->diffInDays($start_day) >= $unit * 2){
                $i = 2;
            } else if($created_at->diffInDays($start_day) >= $unit * 1){
                $i = 1;
            } else {
                $i = 0;
            }

            // 総売上高
            $sales_amount_total += $order->product_price * $order->number;

            if($order->state_id == 3){ // キャンセル
                $sales[$i]["sales_amount"] += 0;
                $cancel_count++;
            } else {
                if($order->state_id == 2) { // 取引完了
                    // 決算データ用
                    $sales_amount_real += $order->product_price * $order->number;
                    $orders_finish_count++;

                    // グラフ用
                    $order_payment = $order->product_price * $order->number;
                    $sales[$i]["sales_amount"] += $order_payment;
                }
                // クーポン
                if($order->coupon_id){
                    $coupon_count++;
                    $coupon_amount += $order->coupon_discount;
                }
            }

        }


        $result = array();
        // $result["orders"] = $orders;
        $result["sales"] = $sales; // 4半期ごとの売上情報 グラフ用
        $result["orders_count"] = $orders_count; // 注文機会（キャンセルや未完了込み）
        $result["cancel_count"] = $cancel_count; // キャンセル回数
        $result["orders_finish_count"] = $orders_finish_count; // 注文完了回数
        $result["cancel_percentage"] = round($cancel_count / $orders_count,2) * 100; // キャンセル率
        $result["coupon_count"] = $coupon_count; // クーポン使用回数
        $result["coupon_discount"] = $coupon_amount; // クーポン使用金額の累計
        $result["coupon_percentage"] = round($coupon_count / $orders_count,2) * 100; // クーポン使用率
        $result["sales_amount_total"] = $sales_amount_total;
        $result["sales_amount"] = $sales_amount_total - $sales_amount_real - $coupon_amount; // 最終利益
        return $result;

    }

}