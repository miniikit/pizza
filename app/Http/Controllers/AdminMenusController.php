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
use App\Http\Requests\AdminMenuAddForm;
use App\Http\Requests\AdminMenuEditForm;
use App\Product;
use App\ProductPrice;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;    //ログインユーザを判別


class AdminMenusController extends Controller
{

    public function index()
    {

        $products = Product::with('productPrice', 'genre')->get();

        return view('pizzzzza.menu.index', compact('products'));
    }

    public function destroy($id) {

        $product = Product::with('productPrice', 'genre')->find($id);

        $product->sales_end_date = Carbon::today();
        $product->save();

        $product->delete();

        Flash::success('削除しました。');

        return redirect()->route('AdminMenu');

    }

    public function history()
    {

        $products = Product::withTrashed()->with('productPrice', 'genre')->get();

        return view('pizzzzza.menu.history', compact('products'));
    }

    public function show($id)
    {

        $product = Product::withTrashed()->with('productPrice', 'genre')->find($id);

        return view('pizzzzza.menu.show', compact('product'));
    }

    public function edit($id)
    {

        $product = Product::withTrashed()->with('productPrice', 'genre')->find($id);

        return view('/pizzzzza.menu.edit', compact('product'));
    }

    public function update(AdminMenuEditForm $request,$id) {

        $product = Product::withTrashed()->find($id);



        Flash::success('更新完了しました。');

//        return redirect()->route('AdminMenu');

    }


    public function add()
    {
        return view('pizzzzza.menu.add');
    }

    //
    public function store(AdminMenuAddForm $request)
    {
        $data = $request->all();
        $carbon = Carbon::now();


        $file = $request->file('product_img');

        $filename = $carbon->format('Y-m-d-H-i-s') . '.jpg';
        $file->move(public_path('images/product/'), $filename);


        if (empty($data['product_sales_end_day'])) {
            $endDate = NULL;
        } else {
            $endDate = $data['product_sales_end_day'];
        }


        $product = Product::create([
            'product_name' => $data['product_name'],
            'price_id' => 0,
            'product_image' => '/images/product/' . $filename,
            'product_text' => $data['product_text'],
            'genre_id' => $data['product_genre_id'],
            'sales_start_date' => $data['product_sales_start_day'],
            'sales_end_date' => $endDate,
        ]);

        $price  =ProductPrice::create([
            'product_id' => $product->id,
            'product_price' => $data['product_price'],
            'price_change_startdate' => $data['product_sales_start_day'],
            'price_change_enddate' => $endDate,
            'employee_id' => Auth::user()->id,
        ]);

        $product->price_id = $price->id;
        $product->save();

        Flash::success('登録完了しました。');

        return redirect()->route('AdminMenu');

    }


}
