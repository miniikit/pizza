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
    //課題：１ページ１０件とかになれば、処理が変わる。
    //メモ：selectを、valueにすると、ずつ取得するから、for文で回すのに有効か？
    //開発の余地：order_statesが1の場合、制作済み。2の場合、まだ。って処理を追加？
       public function orderHistory()
    {
        //認証済み？
        if (Auth::check()) {
            //ユーザIDを取得
                $userId = Auth::user()->id;
            //注文IDごとに、GROUPBY して、「注文日」「注文番号」「合計金額」「クーポン（NULL/int）」を取得。
                $orders = DB::table('orders_master')->leftjoin('coupons_master', 'coupons_master.coupon_number', '=', 'orders_master.coupon_id')->join('users', 'users.id', '=', 'orders_master.user_id')->join('orders_details_table', 'orders_details_table.id', '=', 'orders_master.id')->join('products_prices_master', 'products_prices_master.id', '=', 'orders_details_table.price_id')->where('users.id', $userId)->select('orders_details_table.id',DB::raw('SUM(products_prices_master.product_price * orders_details_table.number) as total_price'),'orders_master.order_date','coupons_master.coupon_discount')->groupby('orders_details_table.id','orders_master.order_date','coupons_master.coupon_discount')->get();
            //取得した項目を、送信。
                return view('mypage.order.history', [ "orders" => $orders]);
        } else {
            //アクセスエラーページに飛ばす。 Permission Denied.
            return ('ログインしてください！');
        }


    }

    //注文詳細ページ
    //ユーザID一致の、注文一覧を取得する。注文IDが異なってても、その人の注文をすべて。
    // 重要　$contentsArray = DB::table('orders_master')->leftjoin('coupons_master', 'coupons_master.coupon_number', '=', 'orders_master.coupon_id')->join('users', 'users.id', '=', 'orders_master.user_id')->join('orders_details_table', 'orders_details_table.id', '=', 'orders_master.id')->join('products_prices_master', 'products_prices_master.id', '=', 'orders_details_table.price_id')->where('users.id', $userId)->select('orders_master.id', 'orders_master.order_date', 'orders_master.order_appointment_date', 'orders_master.state_id', 'coupons_master.coupon_discount', 'products_prices_master.product_price', 'orders_details_table.number')->get();

    public function orderDetail()
    {
        return view('mypage.order.detail');
    }

    //登録情報確認ページ
    public function detail()
    {
        return view('mypage.detail');
    }

    //登録情報編集ページ
    public function edit()
    {
        return view('mypage.edit');
    }

    //更新確認ページ
    public function confirm()
    {
        return view('mypage.confirm');
    }
}
