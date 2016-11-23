<?php
/**
 *
 *  顧客用ページ
 *      ・注文確認ページ
 *      ・注文完了ページ
 *
 */
namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Service\CartService;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class OrdersController extends Controller
{
    //  注文確認ページ
    public function index(){

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $cart = new CartService();
        list($products,$productCount,$total) = $cart->showCart();

        $date = Carbon::now()->addHour();

        return view('order.index',compact('user','products','productCount','total','date'));

    }

    public function insert(Request $request) {

        // リクエストゲット
        $date = $request->input('date');
        $time = $request->input('time');

        $datetime = $date .' '. $time;

        // もし現在時刻より前だったら
        if ($datetime <= Carbon::now()->format('Y-m-d H:i')) {

            Session::flash('error_text', '配達希望日時 : 申し訳ありませんが、過去に配達することはできません。');

            return redirect()->route('order');
        }


        // カートの中身を取得
        $cart = new CartService();
        list($products,$productCount,$total) = $cart->showCart();

        // オーダする

        $userId = Auth::user()->id;

        $order = new OrderService();
        $order->insert($products,$productCount,$userId,$datetime);

        return redirect()->route('complete');
    }


    //  注文完了ページ
    public function complete(){

        return view('order.complete');

    }
}
