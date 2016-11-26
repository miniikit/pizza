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

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;  //サービスに移植後削除
use App\Http\Requests\AdminMenuForm;

class AdminMenusController extends Controller
{

    public function index()
    {
        //
        //　商品の情報と価格を連結
        //`


        $products = DB::table('products_master')->join('products_prices_master','products_master.price_id','=','products_prices_master.id')->get();


        /*
          +"id": 1
          +"product_name": "明太バターチーズ"
          +"price_id": 1
          +"product_image": "/images/product/1.jpg"
          +"product_text": "大きくカットしたポテトにコーンとベーコンをトッピングして、明太クリームソース、バター、チーズを合わせた、家族で楽しめるピザです。"
          +"genre_id": 1
          +"sales_start_date": "2016-10-10"
          +"sales_end_date": null
          +"created_at": "2016-11-24 17:47:35"
          +"updated_at": "2016-11-24 17:47:35"
          +"deleted_at": null
          +"product_id": 1
          +"product_price": 1990
          +"price_change_startdate": "2016-10-10"
          +"price_change_enddate": null
          +"employee_id": 1
         */

        return view('pizzzzza.menu.index', compact('products') );
    }





    //
    public function push(){

        return redirect('pizzzzza.menu');
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
            if(!$request->has('menu')){
                //ボタンが押されずにとんできた、不正な処理
                return redirect('/pizzzzza/login');
            }

            //商品が選択されていない場合の処理
            if(!$request->has('id')){
                //エラーメッセージを返す予定
                $message["status"] = "error";
                $message["text"] = "エラー：商品を選択してください";
                $message["class"] = "menu menu-error";
                return redirect('/pizzzzza/menu')->with('message',$message);
            }


        //
        //  フォームからの値を取得。
        //

            //  どちらのボタンが押されたか判定
            $judge = htmlspecialchars($request->menu); //"edit" or "end"が入る

            //  選択された商品のIDを取得する。
            $productId = htmlspecialchars($request->id);


        //
        //  処理１：編集ボタンが押された場合。（編集ページへのリダイレクト）
        //

            if($judge == "edit"){

                // DBから該当商品の情報を取得
                $products = DB::table('products_master')->join('products_prices_master','products_master.price_id','=','products_prices_master.id')->where('products_master.id','=',$productId)->first();

                //ジャンル情報を取得
                $genres = DB::table('genres_master')->get();

                //販売状況を取得
                $sales_status = array();
                if(is_null($products->deleted_at)){
                    $sales_status["status"] = "販売中";
                    $sales_status["class"] = "sales_status_on";
                }else{
                    $sales_status["status"] = "販売終了";
                    $sales_status["class"] = "sales_status_off";
                }

                return view('/pizzzzza/menu/edit',compact('products','genres','sales_status'));
                //return redirect('pizzzzza/menu/edit')->with('products',$products);
            }


        //
        //  処理２：販売終了ボタンが押された場合。（この中で販売を実際に終了させる。販売終了日に現在日時を設定する。）
        //

            //
            //  処理２−１：既にソフトデリートされているものか確認する（本当はAjaxの方が良いが）
            //

            if($judge == "end"){
                $value = DB::table('products_master')->where('id', $productId)->first();
                if(!is_null($value->deleted_at)){
                    $message["status"] = "error";
                    $message["text"] = "既に販売が終了された商品です。";
                    $message["class"] = "menu menu-error";

                    return redirect('/pizzzzza/menu')->with('message',$message);
                }
            }

            //
            //  処理２−２：実際にソフトデリートする
            //
            if($judge == "end"){

                $now = Carbon::now();

                //手動でのソフトデリート。
                DB::table('products_master')->where('id', $productId)->update(['deleted_at' => $now]);
                $message["status"] = "end_ok";
                $message["text"] = "選択された商品の販売を終了しました。";
                $message["class"] = "menu menu-end-complete";

                return redirect('/pizzzzza/menu')->with('message',$message);
            }


        //
        //  最終エラー処理（たどりつくはずのない処理）
        //
        return redirect('pizzzzza/login');
    }






    //商品情報が編集され、更新ボタンが押された時の処理。
    public function edit(Requests\AdminMenuForm $request){
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
        //  バリデーション、
        //

        //
        //  エラー処理
        //



        //
        //  エラー１：
        //




        $a = $request->all();
        dd($a);

    }



    public function add()
    {

        return view('pizzzzza.menu.add');
    }
}
