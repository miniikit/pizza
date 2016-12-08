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

        $orders = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->join('orders_details_table','orders_details_table.id','=','orders_master.id')->get();

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



}