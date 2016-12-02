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
        //　※ID、クーポンマスタの値を返したいのに、クーポン種別マスタのIDで上書きされる。だからIDも一緒に返却する。
        $coupon = DB::table('coupons_master')->join('coupons_types_master','coupons_types_master.id','=','coupons_master.coupons_types_id')->where('coupons_master.id','=',$id)->first();

        //　※ID、クーポンマスタの値を返したいのに、クーポン種別マスタのIDで上書きされる。だからIDも一緒に返却する。
        return view('pizzzzza.coupon.show',compact('coupon','id'));
    }

    //  クーポン編集ページ
    public function edit($id) {
        // 処理内容：クーポンの編集画面を表示。（値引き・プレゼント両対応）
        //  １．クーポンIDを取得し、DBから値を取得
        //  ２．viewで表示する内容が若干異なるので、クーポン種別が何か判別
        //  ３．渡されたIDを基にviewのform>input>valueに初期値を設定


        //DBから取得（クーポン＋クーポン種別を、$idと一致する１つだけ取得）
            $coupon = DB::table('coupons_master')->join('coupons_types_master','coupons_master.coupons_types_id','=','coupons_types_master.id')->where('coupons_master.id','=',$id)->first();

        //もし、クーポン種別が「プレゼント」であれば、どの商品が無料になるのかを表示するために商品表と結合する
            $couponTypeId = $coupon->coupons_types_id;
            if($couponTypeId == 2){
                $coupon = DB::table('coupons_master')->join('coupons_types_master','coupons_master.coupons_types_id','=','coupons_types_master.id')->join('products_master','products_master.id','=','coupons_master.product_id')->where('coupons_master.id','=',$id)->first();
            }

        //クーポン種別を取得する(Viewで使用）
            $couponTypes = DB::table('coupons_types_master')->get();

        return view('pizzzzza.coupon.list.edit',compact('coupon','couponTypes','couponTarget','id'));

    }

    // クーポン更新：edit(編集)ページからの遷移
    public function update(Request $request){

        if($request->status = "更新"){

        }

        //
        //  POSTデータの受け取り
        //

        $coupon_name = $request->coupon_name;
        $coupon_num = $request->coupon_num;
        $coupon_discount = $request->coupon_discount;
        $coupon_max = $request->coupon_max;
        $coupon_conditions_price = $request->coupon_conditions_price;
        $coupon_conditions_first = $request->coupon_conditions_first;
        $coupon_type_id = $request->coupon_type_id;
        $coupon_end_date = $request->coupon_end_date;


        dd($request->all());
    }

    // クーポン削除：show(詳細)ページからの遷移
    public function delete($id){



    }
}