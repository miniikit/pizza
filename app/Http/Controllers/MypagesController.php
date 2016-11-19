<?php
/**
 *
 *  顧客用ページ
 *      ・注文履歴ページ
 *      ・注文詳細ページ
 *      ・登録情報確認ページ
 *      ・登録情報編集ページ
 *      ・登録情報更新確認ページ
 *
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Http\Requests;
use App\Service\MypageService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Support\Facades\DB;  //サービスに移植後削除

class MypagesController extends Controller
{
    //注文履歴ページ
    public function orderHistory(){

        //あとでこのif文に処理を入れる
        if(Auth::check()){  //ログインしている

        }else{  //ログインしていない

        }

        //ユーザID一致の、注文一覧を取得する
        $userId = Auth::user()->id;
        $contentsArray = DB::table('orders_master')->join('coupons_master','coupons_master.coupon_number','=','orders_master.coupon_id')->join('users','users.id','=','orders_master.user_id')->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('products_prices_master','products_prices_master.product_id','=','orders_details_table.product_id')->where('users.id',$userId)->select('orders_master.id','orders_master.order_date','orders_master.order_appointment_date','orders_master.state_id','coupons_master.coupon_discount','orders_details_table.product_id','orders_details_table.number')->get();

        $dbUserId = DB::table('orders_master')->join('users','users.id','=',$userId)-get();

        // ->where('orders_master.state_id',1)これはいらない
        dd($contentsArray,$userId);
           // $object = new MypageService();
           // $index = $object->showHistory();
           // list($subject,$b) = $index;
           // dd($subject,$b);

        list($contents) = $contentsArray;
        dd($contents);
        return view('mypage.order.history',compact('$index'));
    }

    //注文詳細ページ
    public function orderDetail(){
        return view('mypage.order.detail');
    }

    //登録情報確認ページ
    public function detail(){
        return view('mypage.detail');
    }

    //登録情報編集ページ
    public function edit(){
        return view('mypage.edit');
    }

    //更新確認ページ
    public function confirm(){
        return view('mypage.confirm');
    }
}
