<?php
/**
 *
 *  従業員用商品管理ページ
 *      ・商品一覧ページ
 *      ・商品編集ページ
 *      ・商品追加ページ
 *
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Product;

class AdminMenusController extends Controller
{

    public function index()
    {
        $products = Product::with('productPrice')->get();
        return view('pizzzzza.menu.index', compact('products'));
    }

    public function edit()
    {
        return view('pizzzzza.menu.edit');
    }


    public function add()
    {
        return view('pizzzzza.menu.add');
    }
}
