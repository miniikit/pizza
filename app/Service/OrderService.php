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
use

class OrderService
{

    public function insert($products, $productCount,$userId,$datetime)
    {

        Order::create([
            'order_date' => Carbon::now(),
            'order_appointment_date' => $datetime,
            'coupon_id' => null,
            'state_id' => 100,
            'user_id' => $userId,
        ]);

        foreach ($products as $product) {
        }
        


        CartService::clear();

    }


}