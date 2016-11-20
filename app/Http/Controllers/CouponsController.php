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

use Illuminate\Http\Request;

use App\Http\Requests;

class CouponsController extends Controller
{
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
        return view('pizzzzza.coupon.list');
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
}
