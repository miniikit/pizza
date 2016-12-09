<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class AdminController extends Controller
{
    public function orderIndex(){

        // $orders = Order::with('user','coupon','state','detail.productPrice')->where('state_id','=',1)->get()->toJson()


        $orders = DB::table('orders_master')->join('orders_details_table','orders_master.id','=','orders_details_table.id')->whereIn('orders_master.state_id',[1,2,3])->get();

        return view('pizzzzza.order.index',compact('orders'));
    }


    public function orderGet(){

        $orders = Order::with('user','coupon','state','employee.user','detail.productPrice.product.genre')->where('state_id','=',1)->orderBy('order_appointment_date','asc')->get()->toArray();

        return response()->json($orders);

    }

    public function destroy(Request $request) {

        $orderId = $request->input('0');

        $order = Order::find($orderId);

        $order->state_id = 3;
        $order->save();

        return Null;
    }

    public function success(Request $request) {

        $orderId = $request->input('0');

        $order = Order::find($orderId);

        $order->state_id = 2;
        $order->save();

        return Null;

    }
}
