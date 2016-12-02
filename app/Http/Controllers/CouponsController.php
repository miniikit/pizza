<?php
/**
 *
 *  従業員用ページ
 *      ・クーポンメニューページ
 *      【クーポン発券】
 *      ・クーポン種別選択ページ
 *      ・クーポン種別選択ページ＞値引きクーポン新規発行ページ
 *      ・クーポン種別選択ページ＞（１）プレゼントクーポン新規発行ページ
 *      ・クーポン種別選択ページ＞（２）プレゼントクーポン商品選択ページ
 *      【クーポン開催中】
 *      ・開催中クーポン一覧ページ
 *      ・開催中クーポン一覧ページ＞値引きクーポン編集ページ
 *      ・開催中クーポン一覧ページ＞プレゼントクーポン編集ページ
 *      【クーポン過去一覧】
 *      ・過去クーポン一覧ページ
 *
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Coupon;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //  クーポンメニューページ
    public function couponMenu()  {
        return view('pizzzzza.coupon.menu');
    }

    //  クーポン種別選択ページ
    public function couponNew()  {
        return view('pizzzzza.coupon.add');
    }

    //  クーポン種別選択ページ＞値引きクーポン新規発行ページ
    public function couponNewDiscount()  {
        return view('pizzzzza.coupon.add.discount.input');
    }

    //  クーポン種別選択ページ＞（１）プレゼントクーポン新規発行ページ
    public function couponNewGiftInput()  {
        return view('pizzzzza.coupon.add.gift.input');
    }

    //  クーポン種別選択ページ＞（２）プレゼントクーポン商品選択ページ
    public function couponNewGiftSelect()  {
        return view('pizzzzza.coupon.new.gift.select');
    }

    //  開催中クーポン一覧ページ
    public function couponNowList()  {
        $coupons = DB::table('coupons_master')->get();
        //dd($coupons);
        return view('pizzzzza.coupon.list',compact('coupons'));
    }

    //  開催中クーポン一覧ページ＞値引きクーポン編集ページ
    public function couponNowDiscountEdit()  {
        return view('pizzzzza.coupon.list.discount.edit');
    }

    //  開催中クーポン一覧ページ＞プレゼントクーポン編集ページ
    public function couponNowGiftEdit()  {
        return view('pizzzzza.coupon.list.gift.edit');
    }

    //  過去クーポン一覧ページ
    public function couponHistory()  {
        return view('pizzzzza.coupon.history');
    }

    //  クーポン詳細ページ
    public function show($id)  {

        // $idのクーポン詳細情報を、クーポン種別と共に取得
        $coupon = DB::table('coupons_master')->join('coupons_types_master','coupons_master.coupons_types_id','=','coupons_types_master.id')->where('coupons_master.id','=',$id)->first();
//
//        //
//        //  クーポン編集ボタンが押された時、IDをセッションに保存（編集画面で使用）
//        //
//            // セッションにすでにあれば削除
//            if(session()->has('coupon_selected_item')){
//                session()->forget('coupon_selected_item');
//            }
//            // クーポン編集ボタンが押された時にこの値を参照する。
//            session()->put('coupon_selected_item',$coupon->id);

        return view('pizzzzza.coupon.show',compact('coupon'));
    }

    //  クーポン編集ページ
    public function edit($id) {
        // 処理内容：クーポンの編集画面を表示。（値引き・プレゼント両対応）
        //  クーポンIDを取得し、DBから値を取得
        //  viewで表示する内容が若干異なるので、クーポン種別が何か判別
        //  渡されたIDを基にviewのform>input>valueに初期値を設定

//
//        //クーポンID取得
//            if(session()->has('coupon_selected_item')) {
//                $coupon_id = session()->get('coupon_selected_item');
//            }else{
//                //セッションエラー
//                return redirect('/pizzzzza/coupon/list');
//            }

        //DBから取得
            $coupon = Coupon::with('productName')->find($id);

        //クーポン種別を取得


        return view('pizzzzza.coupon.list.edit',compact('coupon'));

    }

    public function update($id){

    }

    public function delete($id){



    }
}