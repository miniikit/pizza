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

use Illuminate\Support\Facades\DB;  //サービスに移植後削除


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


    //クーポンが入力された場合の処理
    public function coupon(Request $request){

        //
        //  POSTデータ（クーポン番号）の受け取り
        //

        //念のため値をすべて受け取り
        $post_data = $request->all();                   // ['user' => '[userの入力値]', 'passwd' => '[passwdの入力値]']
        //クーポン番号だけ取得
        $input_coupon = $post_data['number'];           // "入力値"


        //
        //  DBに、そのクーポン番号が存在するか確認
        //

        //入力されたクーポン番号が見つかるか
        $dbTmp = DB::table('coupons_master')->where('coupon_number','=',$input_coupon)->get();

        //クーポンが見つからなければ終了する
        if(!count($dbTmp) > 0){
            header("Content-type: text/plain; charset=UTF-8");
            echo 'ご入力いただいたクーポンが見つかりませんでした。';
        }


        //
        //  DBに存在するので、条件を満たしているかチェックする
        //

        //DBの値を、参照できるように変換
        list($dbCoupon) = $dbTmp;

        //クーポンの開催期間中であるか。
        $today = Carbon::now()->format('Y-m-d');
        //dd($today,$dbCoupon->coupon_start_date,$dbCoupon);

        //クーポンが、開催期間中であることを判定する処理　（NULL許可なので処理が二つに）
        if(is_null($dbCoupon->coupon_end_date)){
            //クーポン終了日がNULLであった場合の処理
            if($dbCoupon->coupon_start_date <= $today){
                echo "クーポン開催期間内です";
                echo "終了日NULL";
            }else{
                //エラーメッセージで処理終了
                echo "クーポン開催期間外です";
            }
        }else{
            //クーポン終了日が設定されていた場合の処理
            if($dbCoupon->coupon_start_date <= $today && $dbCoupon->coupon_end_date >= $today){
                echo "クーポン開催期間内です";
                echo "終了日：" . $dbCoupon->coupon_end_date;
            }else{
                //エラーメッセージで処理終了
                echo "クーポン開催期間外です";
            }
        }


        echo $dbCoupon->coupon_start_date . "<br>";
        echo $dbCoupon->coupon_end_date . "<br>";
        echo $today;

        /*
        +"id": 1
        +"coupon_name": "500円値引きクーポン"
        +"coupon_discount": 500
        +"coupon_conditions_money": 3000
        +"product_id": 1
        +"coupon_start_date": "2016-11-24"
        +"coupon_end_date": null
        +"coupon_number": "00000001"
        +"coupon_conditions_count": 1
        +"coupon_conditions_first": null
        +"created_at": "2016-11-24 11:32:04"
        +"updated_at": "2016-11-24 11:32:04"
        +"deleted_at": null
        */

        dd($input_coupon,$dbCoupon);

        // Ajax理解用。残しといて
        header("Content-type: text/plain; charset=UTF-8");
        if (isset($heisei['request']))
        {
            //ここに何かしらの処理を書く（DB登録やファイルへの書き込みなど）
            echo "OK";
        }
        else
        {
            echo 'The parameter of "request" is not found.';
        }
    }


    //  注文完了ページ
    public function complete(){

        return view('order.complete');

    }
}
