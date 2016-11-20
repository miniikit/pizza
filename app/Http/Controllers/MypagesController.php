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

        //最後に、このif文に処理を入れる
        if(Auth::check()){  //ログインしている
            $userId = Auth::user()->id;
        }else{  //ログインしていない
            $userId = 4;    //ちかざわさんをテストでいれる
            //アクセスエラーページに飛ばす。 Permission Denied.
        }

        //課題：１ページ１０件とかになれば、処理が変わる。
        //メモ：selectを、valueにすると、ずつ取得するから、for文で回すのに有効か？

        //このへんで、　注文IDが何個あるかをDBからカウントし、その回数分forを回してとる方法に変更か。
            //ユーザIDがログイン中と一致する人の、注文総件数は何件か。
            $orderCount = 0;
            $orderCount = DB::table('orders_master')->join('users','orders_master.user_id','=','users.id')->where('users.id','=',$userId)->count();

            //注文回数文、繰り返す。
            for($i=0; $i<$orderCount; $i++){
                //繰り返し処理が入る。

            }

        //ユーザID一致の、注文一覧を取得する。注文IDが異なってても、その人の注文をすべて。
        $contentsArray = DB::table('orders_master')->leftjoin('coupons_master','coupons_master.coupon_number','=','orders_master.coupon_id')->join('users','users.id','=','orders_master.user_id')->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('products_prices_master','products_prices_master.id','=','orders_details_table.price_id')->where('users.id',$userId)->select('orders_master.id','orders_master.order_date','orders_master.order_appointment_date','orders_master.state_id','coupons_master.coupon_discount','products_prices_master.product_price','orders_details_table.number')->get();

        $contentsArray2 = DB::table('orders_master')->leftjoin('coupons_master','coupons_master.coupon_number','=','orders_master.coupon_id')->join('users','users.id','=','orders_master.user_id')->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('products_prices_master','products_prices_master.id','=','orders_details_table.price_id')->where('users.id',$userId)->groupby('orders_master.id');
        dd($contentsArray2);
        //商品金額×個数を求める。
        $sum = 0;
        foreach($contentsArray as $item){
            $price = $item->product_price;
            $num = $item->number;
            $sum += ($price * $num);
        }

        //クーポンを値引きする(0=>coupon_discount:500とか。foreachかlist使う必要あり。または、注文IDを固定するか。)
        $orderCoupon = DB::table('orders_master')->join('users','orders_master.user_id','=','users.id')->where('users.id','=',$userId)->join('coupons_master','coupons_master.coupon_number','=','orders_master.coupon_id')->select('coupons_master.coupon_discount')->get();
        dd($orderCoupon);
        list($contents) = $contentsArray;
        dd($contents);

        // ->where('orders_master.state_id',1)これはいらない

           // $object = new MypageService();
           // $index = $object->showHistory();
           // list($subject,$b) = $index;
           // dd($subject,$b);


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
