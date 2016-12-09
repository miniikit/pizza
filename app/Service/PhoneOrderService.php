<?php


namespace App\Service;
use App\User;
use Illuminate\Support\Facades\DB;

class PhoneOrderService
{
    //電話番号が一致するユーザ
    public function searchPhoneNumber($phone) {

        $user = User::with('gender')->where('phone','=',$phone)->get();

        return $user;

    }

    //ユーザ情報を取得
    public function getUser($id) {

        $user = DB::table('users')->where('id','=',$id)->first();

        return $user;
    }

    //注文回数を取得
    public function getOrderCount($id){

        $count = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->count();

        return $count;
    }

    //注文状況を取得
    public function getOrders($id){

        //注文マスタ＋注文詳細テーブル＋価格マスタ＋商品マスタ＋状態マスタの結合。
        $orders = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('products_prices_master','orders_details_table.price_id','=','products_prices_master.id')->join('products_master','products_master.price_id','=','products_prices_master.id')->join('states_master','states_master.id','=','orders_master.state_id')->get();

        return $orders;
    }

    //累計購入金額を取得
    public function getOrderTotal($id){

        $orders = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('products_prices_master','orders_details_table.price_id','=','products_prices_master.id')->get();

        $total = 0;

        foreach($orders as $order){
            $total += $order->product_price * $order->number;
        }

        return $total;
    }

    //クーポン使用金額
    public function getOrderCouponTotal($id){

        $orders = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('coupons_master','coupons_master.id','=','orders_master.coupon_id')->get();

        $total = 0;

        if(count($orders) > 0) {

            foreach ($orders as $order) {
                $total += $order->coupon_discount;
            }

            return $total;

        }else{
            return $total;
        }
    }



}