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
use Illuminate\Support\Facades\Auth;
use App\Service\CartService;


class OrdersController extends Controller
{
    //  注文確認ページ
    public function index(){

        $id = Auth::user()->id;
        $user = User::find($id);

        $cart = new CartService();
        list($products,$productCount,$total) = $cart->showCart();

        return view('order.index',compact('user','products','productCount','total'));

    }

    //  注文完了ページ
    public function complete(){
        return view('order.complete');
    }
}
