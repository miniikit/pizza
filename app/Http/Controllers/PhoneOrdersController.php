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
use App\Http\Requests\AdminPhoneUserAddRequest;
use Illuminate\Http\Request;
use App\Http\Requests\phoneSearchRequest;
use App\Service\PhoneOrderService;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;  //サービスに移植後削除
use App\Product;
use Carbon\Carbon;


use App\Http\Requests\AdminPhoneUserEditRequest;


class PhoneOrdersController extends Controller
{


    //電話番号入力ページ
    public function index()
    {
        return view('pizzzzza.order.accept.input');
    }


    //電話番号入力ページ＞バリデーションチェック処理
    //タスク：：バリデーションチェック
    //public function input(phoneSearchRequest $request){
    public function input(Request $request)
    {

        //$check = new PhoneOrderService();
        //$check->searchPhoneNumber($request->number);
        $check = array();
        $users = DB::table('users')->where('phone', '=', $request->number)->get();

        if (count($users) > 0) {
            $check["status"] = "true";
            $check["message"] = "ユーザが見つかりました。";
            return compact('check', 'users');
        } else {
            $check["status"] = "false";
            $check["message"] = "ユーザが見つかりませんでした。";
            return compact('check');
        }
    }


    public function show($id)
    {
        //$user = new PhoneOrderService();
        //$user->getUser($id);

        $user = DB::table('users')->where('id', '=', $id)->first();

        if (count($user) > 0) {
            return view('pizzzzza.order.accept.customer.show', compact('user'));
        } else {
            return redirect()->route('telSearch');
        }
    }

    //会員情報編集
    public function edit($id)
    {

        $user = DB::table('users')->where('id', '=', $id)->first();

        if (count($user) > 0) {

            if ($user->authority_id == 3) {

                $genders = DB::table('genders_master')->get();

                return view('pizzzzza.order.accept.customer.edit', compact('user', 'genders'));

            } else {

                return view('pizzzzza.order.accept.customer.edit', compact('user'));

            }

        } else {

            return redirect()->route('telSearch');

        }

    }


    // POSTデータの受け皿。
    public function handler(Request $request)
    {
        //
        //  会員情報確認画面からの遷移を想定
        //
        //　※ 想定値 : $request -> detailPost ->  "戻る" / "注文へ" / "編集"
        //

        //会員情報　確認画面からの遷移であるか
        if (isset($request->detailPost)) {

            //電話番号入力ページへ（電話番号の入力間違い）
            if ($request->detailPost == "戻る") {
                return redirect()->route('telSearch');

            //商品選択ページへ（会員情報OK）
            } else if ($request->detailPost == "注文へ") {
                $this->orderSelect($request);
                //この辺で、会員IDをセッションに保存する必要あり。
                return redirect()->route('telOrderSelect',$request->customer_id);

            //会員情報編集ページへ
            } else if ($request->detailPost == "編集") {
                return redirect()->route('telEdit', $request->customer_id);

            //それ以外のボタンが押された
            } else {
                Flash::error('エラーが発生しました。（不正な遷移：エラーコード501）');
                return redirect()->route('orderTop');
            }

        //その他ページからの遷移　（現状ないので、不正な遷移
        }else{
            Flash::error('エラーが発生しました。（不正な遷移：エラーコード501-2）');
            return redirect()->route('orderTop');
        }

    }


    //電話番号入力ページ＞会員情報確認＞会員情報編集＞更新ボタン押された＞Webの、バリデーションチェック＆更新処理
    public function updateWeb(AdminPhoneUserEditRequestForWeb $request,$id)
    {

        $user_update = $request->all();


        //POSTデータの受取
        $name = $user_update['name'];
        $name_katakana = $user_update['name_katakana'];
        $postal = $user_update['postal'];
        $address1 = $user_update['address1'];
        $address2 = $user_update['address2'];
        $address3 = $user_update['address3'];
        $phone = $user_update['phone'];


        //追加POSTデータの受取
        $birthday = $user_update['birthday'];
        $email = $user_update['email'];
        $gender_id = $user_update['gender'];


        //更新
        $success = DB::table('users')->where('users.id', '=', $id)->update(['name' => $name, 'kana' => $name_katakana, 'email' => $email, 'gender_id' => $gender_id, 'birthday' => $birthday, 'postal' => $postal, 'address1' => $address1, 'address2' => $address2, 'address3' => $address3, 'phone' => $phone]);

        //リダイレクト
        if(count($success)>0) {

            Flash::success('会員情報の更新が完了しました。');
            return redirect()->route('telShow', $id);

        }else{

            Flash::danger('会員情報の更新に失敗しました。');
            return redirect()->route('telShow', $id);
        }

    }


    //電話番号入力ページ＞会員情報確認＞会員情報編集＞更新ボタン押された＞バリデーションチェック＆更新処理
    public function updatePhone(AdminPhoneUserEditRequest $request,$id)
    {

        $user_update = $request->all();


        //POSTデータの受取
        $name = $user_update['name'];
        $name_katakana = $user_update['name_katakana'];
        $postal = $user_update['postal'];
        $address1 = $user_update['address1'];
        $address2 = $user_update['address2'];
        $address3 = $user_update['address3'];
        $phone = $user_update['phone'];

        $success = DB::table('users')->where('users.id', '=', $id)->update(['name' => $name, 'kana' => $name_katakana, 'postal' => $postal, 'address1' => $address1, 'address2' => $address2, 'address3' => $address3, 'phone' => $phone]);

        if(count($success) > 0) {

            Flash::success('会員情報の更新が完了しました。');

            return redirect()->route('telShow', $id);

        }else{

            Flash::danger('会員情報の更新に失敗しました。');

            return redirect()->route('telShow', $id);
        }
    }



    //電話番号入力ページ＞お客様情報入力ページ
    public function newCustomer()
    {
        return view('pizzzzza.order.accept.customer.input');
    }


    public function newCustomerInsert(AdminPhoneUserAddRequest $request)
    {

        //POSTデータの受取
        $name = $request->name;
        $name_katakana = $request->kana;
        $postal = $request->postal;
        $address1 = $request->address1;
        $address2 = $request->address2;
        $address3 = $request->address3;
        $phone = $request->phone;


        //登録
        $id = DB::table('users')->insertGetId([
            'name' => $name,
            'kana' => $name_katakana,
            'postal' => $postal,
            'address1' => $address1,
            'address2' => $address2,
            'address3' => $address3,
            'phone' => $phone,
            'authority_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        //リダイレクト
        if(count($id)>0) {

            Flash::success('会員登録が完了しました。');
            return redirect()->route('telShow', $id);

        }else{

            Flash::danger('会員登録が完了しました。');
            return redirect()->route('telShow', $id);

        }

    }


    //商品入力・選択ページ
    public function orderSelect($id)
    {
        $products = DB::table('products_master')->join('products_prices_master', 'products_master.price_id', '=', 'products_prices_master.id')->join('genres_master', 'genres_master.id', '=', 'products_master.genre_id')->orderBy('genre_id', 'asc')->get();
        $pizzacnt = Product::where('genre_id', 1)->count();
        $sidecnt = Product::where('genre_id', 2)->count();
        $drinkcnt = Product::where('genre_id', 3)->count();
        return view('pizzzzza.order.accept.item.select', compact('products', 'pizzacnt', 'sidecnt', 'drinkcnt','id'));
    }


    //注文情報確認ページ
    public function orderConfirm()
    {
        return view('pizzzzza.order.accept.item.confirm');
    }

}
