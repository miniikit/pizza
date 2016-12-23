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
    protected $phoneOrderService;

    public function __construct(PhoneOrderService $phoneOrderService)
    {
        $this->phoneOrderService = $phoneOrderService;
    }



    // 電話番号入力ページ
    public function index()
    {
        // セッション削除
        session()->put("phoneOrderCart", []);
        return view('pizzzzza.order.accept.input');
    }

    // 会員検索処理
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
            return compact('check');
        }

        // 負の数
        if ($phone < 0) {
            $check["status"] = "false";
            $check["message"] = "電話番号は正の数で入力してください。";
            return compact('check');
        }

        // 桁数が10-11桁以外
        if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
            $cnt = strlen($phone);
            $check["status"] = "false";
            $check["message"] = "電話番号は10-11桁で数値のみを入力してください。（現在：" . $cnt . "桁）";
            return compact('check');
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
        $user = $this->phoneOrderService->getUser($id);

        if (count($user) > 0) {

            // 累計注文回数
            $orderCount = $this->phoneOrderService->getOrderCount($id);

            if ($orderCount >= 1) {

                // 注文情報（価格＋注文＋注文詳細＋商品＋状態マスタの連結）
                $orders = $this->phoneOrderService->getOrders($id);

                // 累計注文金額
                $orderTotal = $this->phoneOrderService->getOrderTotal($id);

                // 平均支出金額
                $orderAvg = $orderTotal / $orderCount;

                // クーポン使用総額のカウント
                $orderCouponTotal = $this->phoneOrderService->getOrderCouponTotal($id);

                return view('pizzzzza.order.accept.customer.show', compact('user', 'orders', 'orderCount', 'orderTotal', 'orderAvg', 'orderCouponTotal','id'));

            } else {

                return view('pizzzzza.order.accept.customer.show', compact('user','id'));

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
        $success = $this->phoneOrderService->updateWebCustomer($id, $user_update);

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
        $success = $this->phoneOrderService->updatePhoneCustomer($id, $user_update);

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
        $id = $this->phoneOrderService->newCustomerInsert($new_customer);

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

        // 販売中商品一覧
        $products = $this->phoneOrderService->getNowProducts();

        // カテゴリごとの件数
        $pizzaCount = $this->phoneOrderService->getPizzaCnt();
        $sideCount = $this->phoneOrderService->getSideCnt();
        $drinkCount = $this->phoneOrderService->getDrinkCnt();

        return view('pizzzzza.order.accept.item.select', compact('products', 'pizzaCount', 'sideCount', 'drinkCount', 'id'));
    }

    // カート内リアルタイム反映（商品追加・個数変更）
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

        // 返却
        return compact('cart');

    }

    // カート内リアルタイム反映（初期処理用）
    public function orderCartCheck(){

        // セッションから取り出し
        $cart = session()->get("phoneOrderCart", []);

        return compact('cart');

    }

    // カート内リアルタイム反映（削除処理）
    public function orderDelete(Request $request){

        $product_id = $request->product_name;

        // セッションから取り出し
        $cart = session()->get("phoneOrderCart", []);

        // $product_idを削除
        unset($cart[$product_id]);

        // セッションを再配置
        session()->put('phoneOrderCart', $cart);

        return compact('cart');
    }

    // 注文情報確認ページ
    public function orderConfirm(Request $request,$id)
    {
        // 会員情報
        $user = $this->phoneOrderService->getUser($id);

        // 商品
        $data = $this->phoneOrderService->getPrice($request);

        // 商品一覧
        $items = $data['result'];

        // 合計金額
        $total = $data['total'];

        return view('pizzzzza.order.accept.item.confirm',compact('user','items','total','id'));
    }

    // 購入処理
    public function orderComplete(Request $request,$id){

        // 商品と合計金額
        $data = $this->phoneOrderService->getPrice($request);

        // 商品一覧
        $items = $data['result'];

        // 注文希望日時
        $date = $request->date;
        $time = $request->time;

        $appointment_date = $date .' '. $time;

        // もし現在時刻より前だったら
        if ($appointment_date <= Carbon::now()->format('Y-m-d H:i')) {

            Flash::error('配達希望日時は１時間後より指定可能です。');
            return redirect()->route('telOrderConfirm',$id);
        }

        // DB挿入処理
        $orderId = $this->phoneOrderService->insertOrder($items,$id,$appointment_date);

        // セッション削除
        session()->put("phoneOrderCart", []);

        Flash::success("注文が完了しました。注文番号：$orderId");

        return redirect()->route('orderTop');
    }

}
