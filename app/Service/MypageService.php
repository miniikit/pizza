<?php
/**
 * Created by PhpStorm.
 * User: minion
 * Date: 2016/11/15
 * Time: 14:17
 */


//セッションIDからユーザIDを取得するのが、セッション内不明のため、まだ。

namespace App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class MypageService
{
    public function showHistory(){

        // $history[] = にするとやっこい
        $contentsArray = DB::table('orders_master')->join('coupons_master','coupons_master.coupon_number','=','orders_master.coupon_id')->where('orders_master.state_id',1)->get();

        //list($contents[]) = $contentsArray;

        return $contentsArray;

        if (Auth::check())
        {
            //セッションから、ユーザIDを取得する
                //$userid = session()->get("id？");
                $userid = 1;    //仮

            //DBからユーザIDの一致する注文履歴を取得する。
                $history[] = DB::table('orders_master')->where('user_id',$userid)->get();

            //JOINしてクーポン表を連結する。
                $history[] = DB::table('orders_master')->join('coupons_master','coupons_master.coupon_number','=','orders_master.coupon_id')->where('coupon_id',1)->get();


        }else{
                redirect('/login');
        }
    }
}