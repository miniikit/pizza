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
use \App\Service\CartService;

class CartsController extends Controller
{

    protected $cartService;

    /**
     * CartsController constructor.
     * @param $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    //  カートページ

    public function index()  {


        list($products,$productCount,$total) = $this->cartService->showCart();

        return view('cart.index',compact('products','productCount','total'));
    }

    public function store(Request $request) {

        $id  = $request->get("id");
        $sum = $request->get("sum");


        $this->cartService->addProduct($id,$sum);

        return redirect()->route('cart');
    }

    public function clear() {

        CartService::clear();

        return redirect()->route('cart');
    }

    public function pop($id) {

        $this->cartService->popProduct($id);

        return redirect()->route('cart');

    }

    public function edit(Request $request) {

        $id  = $request->get("id");
        $sum = $request->get("sum");

        $this->cartService->editCartSum($id,$sum);

        return redirect()->route('cart');

    }
}
