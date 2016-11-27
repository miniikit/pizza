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

    //電話番号入力ページ＞お客様情報・注文履歴表示ページ
    public function show(phoneSearchRequest $request){


        $phone = $request->get('phone');

        // 番号からUser情報を引き出す
        $phoneOrder = new PhoneOrderService();
        $userWeb = $phoneOrder->searchPhoneNumber($phone);

        if(!is_null($userWeb)){
            $user = $userWeb;
            return view('pizzzzza.order.accept.customer.detail', compact('user'));
        }


        // Temporary Tableから値を取り出す
        $userTmp = DB::table('temporaries_users_master')->where('temporaries_users_master.phone','=',$phone)->first();

        if (!is_null($userTmp)) {
            $user = $userTmp;
            return view('pizzzzza.order.accept.customer.detail', compact('user'));
        }


        //電話番号が見つからない
        return redirect()->route('newCustomer');

    }




    //電話番号入力ページ＞お客様情報・注文履歴表示ページ＞お客様情報編集ページ
    public function phoneEdit(){

       // $user = DB::table('users')->where('')->get();

        DB::table('temporaries_members_master')->get();

        return view('pizzzzza.order.accept.customer.edit');
    }



    //電話番号入力ページ＞お客様情報入力ページ
    public function newCustomer(){
        return view('pizzzzza.order.accept.customer.input');
    }



    //商品入力・選択ページ
    public function phoneOrderSelect(){
        return view('pizzzzza.order.accept.item.select');
    }



    //注文情報確認ページ
    public function phoneOrderConfirm(){
        return view('pizzzzza.order.accept.item.confirm');
    }
}
