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
use Illuminate\Support\Facades\DB;  // サービスに移植後削除
use App\Product;
use Carbon\Carbon;


use App\Http\Requests\AdminPhoneUserEditRequest;

class PhoneOrdersController extends Controller
{


    // 電話番号入力ページ
    public function index()
    {
        return view('pizzzzza.order.accept.input');
    }


    // 顧客検索
    public function input(Request $request)
    {
        // 電話番号
        $phone = $request->number;

        $check = array();

        //
        // 手動バリデーションチェック
        //

        // 入力なし
        if ($phone <= "") {
            $check["status"] = "false";
            $check["message"] = "電話番号を入力してください。";
            return compact('check', 'users');
        }

        // 負の数
        if ($phone <= 0) {
            $check["status"] = "false";
            $check["message"] = "電話番号は正の数で入力してください。";
            return compact('check', 'users');
        }

        // 桁数が10-11桁以外
        if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
            $cnt = strlen($phone);
            $check["status"] = "false";
            $check["message"] = "電話番号は10-11桁で数値のみを入力してください。（現在：" . $cnt . "桁）";
            return compact('check', 'users');
        }

        // 検索
        $users = DB::table('users')->where('phone', '=', $phone)->get();

        // 結果の返却
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

    // 詳細
    public function show($id)
    {
        $phoneOrder = new PhoneOrderService();
        $user = $phoneOrder->getUser($id);

        if (count($user) > 0) {

            // 累計注文回数
            $orderCount = $phoneOrder->getOrderCount($id);

            if ($orderCount >= 1) {

                // 注文情報（価格＋注文＋注文詳細＋商品＋状態マスタの連結）
                $orders = $phoneOrder->getOrders($id);

                // 累計注文金額
                $orderTotal = $phoneOrder->getOrderTotal($id);

                // 平均支出金額
                $orderAvg = $orderTotal / $orderCount;

                // クーポン使用総額のカウント
                $orderCouponTotal = $phoneOrder->getOrderCouponTotal($id);

                return view('pizzzzza.order.accept.customer.show', compact('user', 'orders', 'orderCount', 'orderTotal', 'orderAvg', 'orderCouponTotal'));

            } else {

                return view('pizzzzza.order.accept.customer.show', compact('user'));

            }


        } else {
            return redirect()->route('telSearch');
        }

    }

    // 会員情報編集
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
        // 　※ 想定値 : $request -> detailPost ->  "戻る" / "注文へ" / "編集"
        // 

        // 会員情報　確認画面からの遷移であるか
        if (isset($request->detailPost)) {

            // 電話番号入力ページへ（電話番号の入力間違い）
            if ($request->detailPost == "戻る") {
                return redirect()->route('telSearch');

                // 商品選択ページへ（会員情報OK）
            } else if ($request->detailPost == "注文へ") {
                $this->orderSelect($request);
                // この辺で、会員IDをセッションに保存する必要あり。
                return redirect()->route('telOrderSelect', $request->customer_id);

                // 会員情報編集ページへ
            } else if ($request->detailPost == "編集") {
                return redirect()->route('telEdit', $request->customer_id);

                // それ以外のボタンが押された
            } else {
                Flash::error('エラーが発生しました。（不正な遷移：エラーコード501）');
                return redirect()->route('orderTop');
            }

            // その他ページからの遷移　（現状ないので、不正な遷移
        } else {
            Flash::error('エラーが発生しました。（不正な遷移：エラーコード501-2）');
            return redirect()->route('orderTop');
        }

    }


    // WEB会員 お届け先住所 更新処理
    public function updateWeb(AdminPhoneUserEditRequestForWeb $request, $id)
    {

        $user_update = $request->all();

        // 更新処理
        $Phone = new PhoneOrderService();
        $success = $Phone->updateWebCustomer($id, $user_update);

        // リダイレクト
        if (count($success) > 0) {

            Flash::success('お届け先情報の更新が完了しました。');
            return redirect()->route('telShow', $id);

        } else {

            Flash::danger('お届け先情報の更新に失敗しました。');
            return redirect()->route('telShow', $id);
        }

    }


    // PHONE会員 お届け先住所 更新処理
    public function updatePhone(AdminPhoneUserEditRequest $request, $id)
    {

        $user_update = $request->all();

        // 更新処理
        $Phone = new PhoneOrderService();
        $success = $Phone->updatePhoneCustomer($id, $user_update);

        // リダイレクト
        if (count($success) > 0) {
            Flash::success('お届け先情報の更新が完了しました。');
            return redirect()->route('telShow', $id);
        } else {
            Flash::danger('お届け先情報の更新に失敗しました。');
            return redirect()->route('telShow', $id);
        }

    }


    // PHONE会員 新規登録
    public function newCustomer()
    {
        return view('pizzzzza.order.accept.customer.input');
    }

    // PHONE会員 追加処理
    public function newCustomerInsert(AdminPhoneUserAddRequest $request)
    {
        $new_customer = $request->all();

        // 追加処理
        $Phone = new PhoneOrderService();
        $id = $Phone->newCustomerInsert($new_customer);

        // リダイレクト
        if (count($id) >= 1) {
            Flash::success('お届け先情報の登録が完了しました。');
            return redirect()->route('telShow', $id);
        } else {
            Flash::danger('お届け先情報の登録が完了しました。');
            return redirect()->route('telShow', $id);
        }

    }

    // 商品選択
    public function orderSelect($id)
    {

        $Phone = new PhoneOrderService();

        // 販売中商品一覧
        $products = $Phone->getNowProducts();

        // カテゴリごとの件数
        $pizzaCount = $Phone->getPizzaCnt();
        $sideCount = $Phone->getSideCnt();
        $drinkCount = $Phone->getDrinkCnt();

        return view('pizzzzza.order.accept.item.select', compact('products', 'pizzaCount', 'sideCount', 'drinkCount', 'id'));
    }

    // カート内リアルタイム反映
    public function orderCart(Request $request)
    {
        // session()->forget('phoneOrderCart');

        // POSTデータ受け取り
        $product_id = $request->product_id;
        $product_num = $request->product_num;

        // セッションから取り出し
        $cart = session()->get("phoneOrderCart", []);

        // 変数に配置
        $cart[$product_id] = $product_num;

        // 削除された場合の処理
        if ($product_num == 0) {
            // $product_idを削除
            unset($cart[$product_id]);
        }

        // セッションを再配置
        session()->put('phoneOrderCart', $cart);


        // 件数
        $count = count($cart);

        return ["cart" => $cart, "status" => "ok", "count" => $count,];

    }

    // 注文情報確認ページ
    public function orderConfirm()
    {
        return view('pizzzzza.order.accept.item.confirm');
    }

}
