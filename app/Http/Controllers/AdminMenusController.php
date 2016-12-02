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
use App\Product;
use App\ProductPrice;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;    //ログインユーザを判別
use App\Http\Requests\AdminMenuForm;


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

        return redirect()->route('employees');

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

    public function update(EmployeeUpdateRequest $request,$id) {

        $product = Product::withTrashed()->with('productPrice', 'genre')->find($id);


        Flash::success('更新完了しました。');

        return redirect()->route('employees');

    }


    public function add()
    {
        return view('pizzzzza.menu.add');
    }

    //
    public function store(AdminMenuAddForm $request)
    {
        $data = $request->all();

        if (empty($data['product_sales_end_day'])) {
            $endDate = NULL;
        } else {
            $endDate = $data['product_sales_end_day'];
        }

//        dd($data);

        $product = Product::create([
            'product_name' => $data['product_name'],
            'price_id' => 0,
            'product_image' => '/images/product/10.jpg',
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


    // メニュー画面:: 編集 or 販売終了ボタンが押される。
    public function nav(Request $request)
    {
        //  処理内容
        //      「選択商品を販売終了（ソフトデリート）」または「選択商品の、編集ページへリダイレクト」する。
        //      渡された値によって処理を振り分ける。
        //  期待値
        //      $request->menu  >>  editかendが入っている。これによって処理を振り分け。
        //      $request->id  >>   選択された商品（１つ）に対し、処理を行う。


        // $message・・・「販売終了」が押された場合の、エラーメッセージ/処理状況/クラスの返却。
        //     $message["status"] : 状態(error/end_ok)
        //     $message["text"] : 表示内容(画面に表示)
        //     $message["class"] : 付加CSSのClass(色でユーザに示す）
        $message = array();

        //
        //  エラー処理
        //

        //ボタンを経由せずに飛んできた場合（JSの不正実行には対応できない）
        if (!$request->has('menu')) {
            //ボタンが押されずにとんできた、不正な処理
            return redirect('/pizzzzza/login');
        }

        //商品が選択されていない場合の処理
        if (!$request->has('id')) {
            //エラーメッセージ
            $message["status"] = "error";
            $message["text"] = "エラー：商品を選択してください";
            $message["class"] = "menu menu-error";
            return redirect('/pizzzzza/menu')->with('message', $message);
        }


        //
        //  フォームからの値を取得。
        //

        //  どちらのボタンが押されたか判定
        $judge = htmlspecialchars($request->menu); //"edit" or "end"が入る

        //  選択された商品のIDを取得する。
        $productId = htmlspecialchars($request->id);


        //
        //  処理２：販売終了ボタンが押された場合。（この中で販売を実際に終了させる。販売終了日に現在日時を設定する。）
        //

        //
        //  処理２−１：既にソフトデリートされているものか確認する（本当はAjaxの方が良いが）
        //

        if ($judge == "end") {
            $value = DB::table('products_master')->where('id', $productId)->first();
            if (!is_null($value->deleted_at)) {
                $message["status"] = "error";
                $message["text"] = "既に販売が終了された商品です。";
                $message["class"] = "menu menu-error";

                return redirect('/pizzzzza/menu')->with('message', $message);
            }
        }

        //
        //  処理２−２：実際にソフトデリートする
        //
        if ($judge == "end") {

            $now = Carbon::now();

            //手動でのソフトデリート。
            DB::table('products_master')->where('id', $productId)->update(['deleted_at' => $now]);
            $message["status"] = "end_ok";
            $message["text"] = "選択された商品の販売を終了しました。";
            $message["class"] = "menu menu-end-complete";

            return redirect('/pizzzzza/menu')->with('message', $message);
        }


        //
        //  最終エラー処理（たどりつくはずのない処理）
        //
        return 'pizzzzza/login';
    }


    //商品情報が編集され、更新ボタンが押された時の処理。
    public function editDo(Requests\AdminMenuForm $request)
    {
        //  処理内容
        //      更新内容を基に、商品情報を更新する。
        //      エラーがあれば、編集ページへ戻す。
        //  期待値
        //      $request->name  >>  商品名
        //      $request->item_text  >>  商品説明
        //      $request-> item_price >> 商品価格
        //      $request-> genre_id >> ジャンルID
        //      $request-> item_start_day >> 販売開始日
        //      $request-> item_end_day >> 販売終了日
        //      $request-> id >> 商品ID

        //
        //  POSTデータを保管
        //

        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $product_text = $request->product_text;
        $product_price = $request->product_price;
        $product_genre_id = $request->product_genre_id;
        $product_sales_start_day = $request->product_sales_start_day;
        $product_sales_end_day = $request->product_sales_end_day;
        $product_img = $request->product_img;


        //本日
        $now = Carbon::now();
        $today = Carbon::today();

        //
        //  エラー処理
        //
        $message = array();

        //
        //  エラー１：販売終了日が、「販売開始日より後」になっていることを確認
        //

        if (!empty($product_sales_end_day)) {
            //販売開始日より、販売終了日が早い日になっている
            if ($product_sales_end_day < $product_sales_start_day) {
                $message["class"] = "menu menu-error";
                $message["text"] = "販売終了日と販売開始日が不正です。";
                $request->session()->put('message', $message);
                //return redirect('/pizzzzza/menu')->with('error-message','販売終了日と販売開始日が不正です。');
                return redirect('/pizzzzza/menu');
            }
        }


        //
        //  DBから更新前の商品情報を取得する。
        //

        $dbProduct = DB::table('products_master')->join('products_prices_master', 'products_master.price_id', '=', 'products_prices_master.id')->where('products_master.id', '=', $product_id)->first();


        //
        //  更新SQL　値のセット（変更箇所のみ）
        //

        //$update[]に、更新内容が入る。
        $update = array();

        if ($dbProduct->product_name != $product_name) {
            $update['product_name'] = $product_name;
        }

        //価格変更時は処理が複雑
        if ($dbProduct->product_price != $product_price) {
            //価格が変更された場合、価格テーブルに価格を挿入する

            $empId = Auth::user()->id;

            // $product_sales_end_dayにNULLを設定して挿入するとエラーが帰ってくるので処理を分けて記述
            if (empty($product_sales_end_day)) {
                $newPriceId = DB::table('products_prices_master')->insertGetId(['product_id' => $product_id, 'product_price' => $product_price, 'price_change_startdate' => $product_sales_start_day, 'price_change_enddate' => NULL,  //NULLor日付
                    'employee_id' => $empId, 'created_at' => $now, 'updated_at' => $now,]);
            } else {
                $newPriceId = DB::table('products_prices_master')->insertGetId(['product_id' => $product_id, 'product_price' => $product_price, 'price_change_startdate' => $product_sales_start_day, 'price_change_enddate' => $product_sales_end_day,  //NULLor日付
                    'employee_id' => $empId, 'created_at' => $now, 'updated_at' => $now,]);
            }

            if (!is_null($newPriceId)) {
                $update['price_id'] = $newPriceId;
            } else {
                //価格表の挿入失敗
                //エラーメッセージと共にeditページへ飛ばす
            }
        }
        if ($dbProduct->product_text != $product_text) {
            $update['product_text'] = $product_text;
        }
        if ($dbProduct->genre_id != $product_genre_id) {
            $update['genre_id'] = $product_genre_id;
        }
        if ($dbProduct->sales_start_date != $product_sales_start_day) {
            $update['sales_start_date'] = $product_sales_start_day;
        }
        if (!is_null($product_sales_end_day)) {
            if ($dbProduct->sales_end_date != $product_sales_end_day) {
                $update['sales_end_date'] = $product_sales_end_day;
            }
        }
        if (!is_null($product_img)) {
            if ($dbProduct->product_image != $product_img) {
                $update['product_image'] = $product_img;
            }
        }
        //更新日時は、更新SQL Runの箇所でセットする。


        //
        //  更新SQL　Run
        //

        //更新内容があれば
        if (isset($update)) {
            //更新日時をセットする
            if ($dbProduct->updated_at != $now) {
                $update['updated_at'] = $now;
            }
            //更新を実行
            $query = DB::table('products_master')->where('id', $product_id)->update($update);
            $message["class"] = "menu menu-end-complete";
            $message["text"] = "商品情報を更新しました";
            $request->session()->put('message', $message);
            return redirect('/pizzzzza/menu');
        } else {
            //更新内容がない
            $message["class"] = "menu menu-error";
            $message["text"] = "内容が変更されていないため更新されませんでした";
            $request->session()->put('message', $message);
            return redirect('/pizzzzza/menu');
        }


        //たどりつくことのないはずの処理
        return redirect('/pizzzzza/login');
    }

}
