<?php
/**
 *
 *  従業員用ページ
 *      ・電話番号入力ページ
 *      ・電話番号入力ページ＞お客様情報・注文履歴表示ページ
 *      ・電話番号入力ページ＞お客様情報・注文履歴表示ページ＞お客様情報編集ページ
 *      ・電話番号入力ページ＞お客様情報入力ページ
 *      ・商品入力・選択ページ
 *      ・注文情報確認ページ
 *
 */
namespace App\Http\Controllers;

use App\Http\Requests\AdminPhoneUserEditRequestForWeb;
use Illuminate\Http\Request;
use App\Http\Requests\phoneSearchRequest;
use App\Service\PhoneOrderService;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;  //サービスに移植後削除
use App\Product;

use App\Http\Requests\AdminPhoneUserEditRequest;


class PhoneOrdersController extends Controller
{


    //電話番号入力ページ
    public function index(){
        return view('pizzzzza.order.accept.input');
    }


    //電話番号入力ページ＞バリデーションチェック処理
    //タスク：：バリデーションチェック
    //public function input(phoneSearchRequest $request){
    public function input(Request $request){

        //$check = new PhoneOrderService();
        //$check->searchPhoneNumber($request->number);
        $check = array();
        $users = DB::table('users')->where('phone','=',$request->number)->get();

        if(count($users) > 0) {
            $check["status"] = "true";
            $check["message"] = "ユーザが見つかりました。";
            return compact('check','users');
        }else{
            $check["status"] = "false";
            $check["message"] = "ユーザが見つかりませんでした。";
            return $check;
        }
        // dd($check);
        //$this->show($request);
        // return redirect('/pizzzzza/order/accept/customer/detail');
    }


    public function show($id){
        dd($id);
    }


    /*

    //電話番号入力ページ＞お客様情報・注文履歴表示ページ
    // ※処理内容：電話番号が見つかれば会員情報を表示し、見つからなければ新規登録ページへリダイレクトする
    public function show(Request $request){

        //
        //  どのページから遷移してきたかによって、$phoneに設定する値を変更する
        //

        if(isset($request->phone)) {    //電話番号入力ページからアクセスした場合
            $phone = $request->get('phone');
            session()->put('phone',$phone);

        }else if(session()->has('phone')){      //戻るボタンからアクセスした場合
            $phone = session()->get('phone');

        }else{      //電話番号入力なし＆セッションに保存されているわけでもない不正なアクセス
            Flash::error('エラーが発生しました。');
            return redirect('/pizzzzza/order/top');
        }


        //
        // 会員情報が見つかるか検索
        //

        // 番号からUser情報を引き出す
        $phoneOrder = new PhoneOrderService();
        $userType = $phoneOrder->searchPhoneNumber($phone);

        //
        //  二人以上見つかる？
        //


        dd($userType);
        if(!is_null($userType)){
            $user = $userType;
            session()->put('phone_order_user_type','web');  // 編集時に使用
            return view('pizzzzza.order.accept.customer.detail', compact('user'));
        }


        //
        //  電話番号が見つからない
        //

        return redirect()->route('newCustomer');

    }

    */

    // POSTデータの受け皿。
    public function handler(Request $request)
    {

        //
        //  顧客情報確認画面からの遷移であれば
        //
        //　※ 想定値 : $request -> detailPost ->  "戻る" / "注文へ" / "編集"
        //


        if (isset($request->detailPost)) {

            //電話番号入力ページへ（電話番号の入力間違い）
            if ($request->detailPost == "戻る") {
                return redirect('/pizzzzza/order/accept/input');

                //商品選択ページへ（会員情報OK）
            } else if ($request->detailPost == "注文へ") {
                $this->orderSelect($request);
                return redirect('/pizzzzza/order/accept/item/select');

                //会員情報編集ページへ
            } else if ($request->detailPost == "編集") {
                if (session()->has('customer_id')) {
                    session()->forget('customer_id');
                }
                session()->put('customer_id', $request->customer_id);
                return redirect('/pizzzzza/order/accept/customer/edit');
            } else {
                Flash::error('エラーが発生しました。');
                return redirect('/pizzzzza/order');
            }

        }
//
//
//    //
//    //  編集画面からの遷移であれば
//    //
//    //  ※　想定値 : $request -> editPost -> "戻る" / "更新"
//
//    if (isset($request->editPost)) {
//
//        if ($request->editPost == "戻る") {
//            return redirect('/pizzzzza/order/accept/customer/detail');
//
//        } else if ($request->editPost == "更新") {
//        }
//    }
    }




    //電話番号入力ページ＞会員情報確認＞会員情報編集＞更新ボタン押された＞Webの、バリデーションチェック＆更新処理
    public function updateWeb(AdminPhoneUserEditRequestForWeb $request){

        //
        //  handlerで、会員情報編集画面から、更新ボタンが押された時：WEB会員バージョン
        //

        $user_update = $request->all();


        //POSTデータの受取
        $name = $user_update['name'];
        $name_katakana = $user_update['name_katakana'];
        $postal = $user_update['postal'];
        $address1 = $user_update['address1'];
        $address2 = $user_update['address2'];
        $address3 = $user_update['address3'];
        $phone = $user_update['phone'];


        //Web会員か、PHONE会員か、会員IDは何番か。
        $userType = session()->get('phone_order_user_type');
        $userId = session()->get('customer_id');


        if($userType == "web"){    //Web会員
            //追加POSTデータの受取
            $birthday = $user_update['birthday'];
            $email = $user_update['email'];
            $gender_id = $user_update['gender'];
            DB::table('users')->where('users.id','=',$userId)->update(['name' => $name,'kana' => $name_katakana,'email' => $email, 'gender_id' => $gender_id, 'birthday' => $birthday, 'postal' => $postal, 'address1' => $address1, 'address2' => $address2, 'address3' => $address3, 'phone' => $phone]);
            Flash::success('会員情報の更新が完了しました。');

        }else{
            Flash::error('セッションエラーが発生しました。');
        }

        return redirect('/pizzzzza/order/accept/customer/detail');

    }


    //電話番号入力ページ＞会員情報確認＞会員情報編集＞更新ボタン押された＞バリデーションチェック＆更新処理
    public function updatePhone(AdminPhoneUserEditRequest $request){

        //
        //  handlerで、会員情報編集画面から、更新ボタンが押された時：WEB会員バージョン
        //

        dd('phone');

        $user_update = $request->all();


        //POSTデータの受取
        $name = $user_update['name'];
        $name_katakana = $user_update['name_katakana'];
        $postal = $user_update['postal'];
        $address1 = $user_update['address1'];
        $address2 = $user_update['address2'];
        $address3 = $user_update['address3'];
        $phone = $user_update['phone'];


        //Web会員か、PHONE会員か、会員IDは何番か。
        $userType = session()->get('phone_order_user_type');
        $userId = session()->get('customer_id');

        if($userType == "phone"){
            DB::table('temporaries_users_master')->where('temporaries_users_master.id','=',$userId)->update(['name' => $name,'kana' => $name_katakana,'postal' => $postal, 'address1' => $address1, 'address2' => $address2, 'address3' => $address3, 'phone' => $phone]);
            Flash::success('会員情報の更新が完了しました。');

        }else{
            Flash::error('エラーが発生しました。');
        }
        return redirect('/pizzzzza/order/accept/customer/detail');
    }




    //電話番号入力ページ＞お客様情報・注文履歴表示ページ＞お客様情報編集ページ
    public function edit(){

        //
        //  @handlerから処理が渡ってくるが、この時sessionに値を保持しそれを使用する。
        //

        // 電話番号入力の際、セッションに会員IDとWEB会員かPHONE会員かを保存しているので、存在確認
        if(!session()->has('customer_id') || !session()->has('phone_order_user_type')){
            Flash::error('エラーが発生しました。');
            return redirect('/pizzzzza/order/top');
        }

        $customer_id = session()->get('customer_id');
        $customer_type = session()->get('phone_order_user_type');

        // 会員の情報を取得し、viewする
        if($customer_type == "web"){
            $user = DB::table('users')->where('users.id','=',$customer_id)->first();
            $genders = DB::table('genders_master')->get();
            return view('pizzzzza.order.accept.customer.edit',compact('user','genders'));

        }else{
            Flash::error('エラーが発生しました。');
            return redirect('/pizzzzza/order/top');
        }


    }




    //電話番号入力ページ＞お客様情報入力ページ
    public function newCustomer(){
        return view('pizzzzza.order.accept.customer.input');
    }



    //商品入力・選択ページ
    public function orderSelect(){
        $products = DB::table('products_master')->join('products_prices_master','products_master.price_id','=','products_prices_master.id')->join('genres_master','genres_master.id','=','products_master.genre_id')->orderBy('genre_id','asc')->get();
        $pizzacnt = Product::where('genre_id',1)->count();
        $sidecnt = Product::where('genre_id',2)->count();
        $drinkcnt = Product::where('genre_id',3)->count();
        return view('pizzzzza.order.accept.item.select', compact('products','pizzacnt','sidecnt','drinkcnt'));
    }




    //注文情報確認ページ
    public function orderConfirm(){
        return view('pizzzzza.order.accept.item.confirm');
    }

}
