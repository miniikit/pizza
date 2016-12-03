<?php
/**
 *
 *  顧客用ページ
 *      ・注文確認ページ
 *      ・注文完了ページ
 *
 */
namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Service\CartService;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
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

        //クーポンIDを取得
        $couponId = NULL;
        if(session()->has('used_coupon_id')) {
            $couponId = session()->pull('used_coupon_id');
        }

        // オーダする

        $user = Auth::user();

        $userId = $user->id;

        $order = new OrderService();
        $order->insert($products,$productCount,$userId,$datetime,$couponId);

        $coupon = NULL;
        if (!empty($couponId)) {
            $coupon = Coupon::find($couponId);
        }

        Mail::send('mail.thanksMail', compact('user','products','productCount','total','datetime','coupon'), function($message) use($user,$products,$productCount,$total,$datetime,$coupon) {

            $message->to($user->email)->subject('注文内容');

        });


        return redirect()->route('complete');

    }


    //クーポンが入力された場合の処理
    public function coupon(Request $request){


        //
        //  ログインチェック
        //

        //認証済みでなければ
        if (!Auth::check()) {
            return 'ログインしてください！';
        }


        //
        //  POSTデータ（クーポン番号）の受け取り
        //

        //念のため値をすべて受け取り
        $post_data = $request->all();                   // ['user' => '[userの入力値]', 'passwd' => '[passwdの入力値]']
        //クーポン番号だけ取得
        $input_coupon = htmlspecialchars($post_data['number']);          // "入力値"


        //
        //  return用メッセージ配列の宣言。
        //

        $message = array();
        $message["coupon_number"] = $input_coupon;


        //
        //  クーポンなしで適用を押された場合はエラー
        //

        if($input_coupon == "" || strlen($input_coupon) == 0){
            $message["message"] = "クーポン番号が入力されていません。";
            $message["status"] = "error";
            return $message;
        }


        //
        //  DBに、そのクーポン番号が存在するか確認
        //

        //入力されたクーポン番号が見つかるか
        $dbTmp = DB::table('coupons_master')->where('coupon_number','=',$input_coupon)->get();

        //クーポンが見つからなければ終了する
        if(!count($dbTmp) > 0){
            $message["message"] =  "クーポンが見つかりませんでした。";
            $message["status"] = "error";
            return $message;
        }


        //
        //  DBにクーポンが存在するので、５つの条件をすべて満たしているかチェックする
        //

        //DBの値を、参照できるように変換
        list($dbCoupon) = $dbTmp;


        //
        //  クーポン条件１：　開催期間中であるか
        //

        //日付
        $today = Carbon::now()->format('Y-m-d');

        //クーポンが、開催期間中であることを判定する処理　（終了日はNULL許可なので処理が二つに）
        if(is_null($dbCoupon->coupon_end_date)){
            //クーポン終了日がNULLであった場合の処理
            if($dbCoupon->coupon_start_date <= $today){
            }else{
                //エラーメッセージで処理終了
                $message["message"] = "こちらのクーポンは開催期間前です。";
                $message["status"] = "error";
                return $message;
            }
        }else{
            //クーポン終了日が設定されていた場合の処理
            if($dbCoupon->coupon_start_date <= $today && $dbCoupon->coupon_end_date >= $today){
            }else{
                //エラーメッセージで処理終了
                $message["message"] = "こちらのクーポンは終了いたしました。";
                $message["status"] = "error";
                return $message;
            }
        }


        //
        //  クーポン条件２：　クーポンの使用条件金額を満たしているか
        //

        //totalを参照
        $cart = new CartService();
        list($products,$productCount,$total) = $cart->showCart();

        $couponMoney = $dbCoupon->coupon_conditions_money;

        if($couponMoney >= $total){ //合計金額より、利用下限金額のほうが大きい場合
            //エラーメッセージで処理終了
            $message["message"] = "クーポンの利用可能金額を満たしておりません。";
            $message["status"] = "error";
            return $message;
        }


        //
        //  クーポン条件３：　カート内に、対象商品が含まれているか
        //


        //対象商品のID
        $dbProductId = $dbCoupon->product_id;

        //クーポンの「対象商品ID」が設定されていれば
        if(!is_null($dbProductId)){

            // カート内の商品IDをセッションから取得。  ※[ 4 => "2", 7=> "3"]のように、「商品ID => "個数"」の形で入る。
            $cartProductsId = session()->get("productCount",[]);

            //商品IDが見つかるか
            if (!array_key_exists($dbProductId, $cartProductsId)) {

                //エラーメッセージで処理終了
                $message["message"] = "対象商品をカートに追加してください。";
                $message["status"] = "error";
                return $message;
            }
        }


        //
        //  クーポン条件４：　初回利用者のみのクーポンであれば、その条件を満たしているか
        //

        $dbFirst = $dbCoupon->coupon_conditions_first;

        $userId = Auth::user()->id;

        if(!is_null($dbFirst)){

            $userOrder = DB::table('orders_master')->where('user_id','=',$userId)->get();

            if(count($userOrder) > 0){

                $message["message"] = "こちらは当店を初めて利用される方限定クーポンになります。";
                $message["status"] = "error";
                return $message;
            }

        }


        //
        //  クーポン条件５：　クーポンごとの使用回数制限を超えていないか
        //

        $couponMax = $dbCoupon->coupon_conditions_count;

        $couponId = $dbCoupon->id;

        if(!is_null($couponMax)){

            $userOrderId = DB::table('orders_master')->where('user_id','=',$userId)->where('coupon_id','=',$couponId)->get();

            if(count($userOrderId) > $couponMax){
                $message["message"] = "クーポンの使用上限回数を超えています。";
                $message["status"] = "error";
                return $message;
            }
        }


        //
        //  クーポン条件６：　すでにクーポンを１度以上適用している場合　（その都度DBから直接価格を算出しているので処理不要）
        //




        //
        //  最終処理：　クーポン情報を配列で返却
        //

        //totalを参照。上の方でtotalは宣言済み。
        if(!$total){
            $cart = new CartService();
            list($products,$productCount,$total) = $cart->showCart();
        }

        //返却用の変数・配列
        $coupon = array();   //return用の配列
        $newTotal = $total - $dbCoupon->coupon_discount;    //値引き後金額
        $name = $dbCoupon->coupon_name;     //クーポン名

        //セッションにクーポンIDを保存
        session()->put('used_coupon_id', $couponId);

        $coupon["status"] = "ok";
        $coupon["message"] = "クーポンを適用しました！";
        $coupon["total"] = $total;  //値引き前金額
        $coupon["newTotal"] = $newTotal;   //値引き後金額
        $coupon["name"] = $name;   //クーポン名


        return $coupon;
    }


    //  注文完了ページ
    public function complete(){

        return view('order.complete');

    }
}
