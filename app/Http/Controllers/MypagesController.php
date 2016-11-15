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

use Illuminate\Support\Facades\DB;  //サービスに移植後削除

class MypagesController extends Controller
{
    //注文履歴ページ
    public function orderHistory(){
        $contentsArray = DB::table('orders_master')->join('coupons_master','coupons_master.coupon_number','=','orders_master.coupon_id')->where('orders_master.state_id',1)->get();

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
