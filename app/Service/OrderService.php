<?php
/**
 * Created by PhpStorm.
 * User: minion
 * Date: 2016/11/15
 * Time: 14:17
 */


//セッションIDからユーザIDを取得するのが、セッション内不明のため、まだ。

namespace App\Service;

use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use App\Service\CartService;

class OrderService
{

    public function insert($products, $productCount,$userId,$datetime,$couponId)
    {

        Order::create([
            'order_date' => Carbon::now(),
            'order_appointment_date' => $datetime,
            'coupon_id' => $couponId,
            'state_id' => 1,
            'user_id' => $userId,
        ]);

        $order = Order::orderBy('id', 'desc')->where('user_id','=',$userId)->take(1)->get();

        list($order) = $order;

        foreach ($products as $product) {

//            dd($order->id,$product->price_id,(int)$productCount[$product->id]);

            OrderDetail::create([
                'id' => $order->id,
                'price_id' => $product->price_id,
                'number' => (int)$productCount[$product->id],
            ]);



        }

        CartService::clear();

    }


}