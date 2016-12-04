<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function orderIndex(){

        // $orders = Order::with('user','coupon','state','detail.productPrice')->where('state_id','=',1)->get()->toJson()


        $orders = DB::table('orders_master')->join('orders_details_table','orders_master.id','=','orders_details_table.id')->whereIn('orders_master.state_id',[1,2,3])->get();

        return view('pizzzzza.order.index',compact('orders'));
    }


    public function orderGet(){

        $orders = Order::with('user','coupon','state','detail.productPrice')->where('state_id','=',1)->get();

        return $orders;

    }
}
