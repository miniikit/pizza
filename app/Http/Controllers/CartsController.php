<?php
/**
 *
 *  顧客用ページ
 *      ・カートページ
 *
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CartsController extends Controller
{
    //  カートページ
    public function index()  {
        return 'cart';
    }

    public function store(Request $request) {

        $id  = $request->get("id");
        $sum = $request->get("sum");

        $cart = new \App\Service\CartService();

        $cart->addProduct($id,$sum);
    }
}
