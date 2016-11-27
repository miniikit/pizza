<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function orderIndex(){

        $orders = DB::table('orders_master')->join('orders_details_table','orders_master.id','=','orders_details_table.id')->whereIn('orders_master.state_id',[1,2,3])->get();

        return view('pizzzzza.order.top',compact('orders'));
    }

    // 顧客情報の表示と、自動ロード機能
    public function orderGet(Request $request){

        $a = $request->all();

        //
        //  POSTデータの受け取り
        //
            $selected_id = $request->order_id;


        //
        //  顧客情報の表示が求められた場合
        //

        $userAddress = array();
        if(isset($selected_id) && $selected_id != 0) {
            $dbUserAddress = DB::table('users')->join('orders_master', 'users.id', '=', 'orders_master.user_id')->where('orders_master.id', '=', $selected_id)->first();

            $userAddress["status"] = "ok";
            $userAddress["name"] = $dbUserAddress->name;
            $userAddress["name_kana"] = $dbUserAddress->kana;
            $userAddress["postal"] = $dbUserAddress->postal;
            $userAddress["address1"] = $dbUserAddress->address1;
            $userAddress["address2"] = $dbUserAddress->address2;
            $userAddress["address3"] = $dbUserAddress->address3;
            $userAddress["phone"] = $dbUserAddress->phone;
            $userAddress["order_appointment_date"] = $dbUserAddress->order_appointment_date;
            $userAddress["coupon_id"] = $dbUserAddress->coupon_id;
            $userAddress["state_id"] = $dbUserAddress->state_id;

            return $userAddress;
        }
            //return redirect('pizzzzza/order/top')->with('useraddress',$userAddress);

            dd('オーダーがみつからん');


        return redirect('pizzzzza/order/top');
    }
}
