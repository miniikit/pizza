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

use Illuminate\Http\Request;
use App\Http\Requests\phoneSearchRequest;
use App\Service\PhoneOrderService;

use Illuminate\Support\Facades\DB;  //サービスに移植後削除




class PhoneOrdersController extends Controller
{




    //電話番号入力ページ
    public function index(){
        return view('pizzzzza.order.accept.input');
    }


    //電話番号入力ページ
    public function input(phoneSearchRequest $request){
        $this->show();
    }

    //電話番号入力ページ＞お客様情報・注文履歴表示ページ
    public function show(Request $request){

        //電話番号入力ページからアクセスした場合
        if(isset($request->phone)) {
            $phone = $request->get('phone');
            session()->put('phone',$phone);
            //
        }else if(session()->has('phone')){
            $phone = session()->get('phone');
        }else{  //電話番号入力なし＆セッションに保存されているわけでもない不正なアクセス
            return redirect('/pizzzzza/login');
        }

        // 番号からUser情報を引き出す
        $phoneOrder = new PhoneOrderService();
        $userWeb = $phoneOrder->searchPhoneNumber($phone);

        if(!is_null($userWeb)){
            $user = $userWeb;
            session()->put('phone_order_user_type','web');  // 編集時に使用
            return view('pizzzzza.order.accept.customer.detail', compact('user'));
        }

        // Temporary Tableから値を取り出す
        $userTmp = DB::table('temporaries_users_master')->where('temporaries_users_master.phone','=',$phone)->first();

        if (!is_null($userTmp)) {
            $user = $userTmp;
            session()->put('phone_order_user_type','user'); //編集時に使用
            return view('pizzzzza.order.accept.customer.detail', compact('user'));
        }

        //電話番号が見つからない
        return redirect()->route('newCustomer');

    }




    //
    public function handler(Request $request){

        //
        //  顧客情報確認画面からの遷移であれば
        //
        //　※ 想定値 : $request -> detailPost ->  "戻る" / "注文へ" / "編集"
        //


        if(isset($request->detailPost)) {

            if($request->detailPost == "戻る"){
                return redirect('/pizzzzza/order/accept/input');
            }else if($request->detailPost == "注文へ"){
                $this->orderSelect($request);
            }else if($request->detailPost == "編集"){
                session()->put('customer_id',$request->customer_id);
                return redirect('/pizzzzza/order/accept/customer/edit');
            }else{
                dd('err');
            }

        }


        //
        //  編集画面からの遷移であれば
        //
        //  ※　想定値 : $request -> editPost -> "戻る" / "更新"

        if(isset($request->editPost)){
            if($request->editPost == "戻る"){
                return redirect('/pizzzzza/order/accept/customer/detail');
            }else if($request->editPost == "更新"){
                //更新SQL
                dd('更新！');
            }
        }
    }



    //電話番号入力ページ＞お客様情報・注文履歴表示ページ＞お客様情報編集ページ
    public function edit(){

        //
        //  @handlerから処理が渡ってくるが、この時sessionに値を保持しそれを使用する。
        //

        if(session()->has('customer_id')){
            $customer_id = session()->get('customer_id');
        }

        $user = DB::table('temporaries_users_master')->where('temporaries_users_master.id','=',$customer_id)->first();

        return view('pizzzzza.order.accept.customer.edit',compact('user'));
    }



    //電話番号入力ページ＞お客様情報入力ページ
    public function newCustomer(){
        return view('pizzzzza.order.accept.customer.input');
    }



    //商品入力・選択ページ
    public function orderSelect(){
        return view('pizzzzza.order.accept.item.select');
    }



    //注文情報確認ページ
    public function orderConfirm(){
        return view('pizzzzza.order.accept.item.confirm');
    }
}
