<?php


namespace App\Service;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhoneOrderService
{

    /**
     * 会員情報確認
     */
    // ユーザ情報を取得
    public function getUser($id) {

        $user = DB::table('users')->where('id','=',$id)->first();

        return $user;
    }

    // 注文回数を取得
    public function getOrderCount($id){

        $count = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->count();

        return $count;
    }

    // 注文状況を取得
    public function getOrders($id){

        // 注文マスタ＋注文詳細テーブル＋価格マスタ＋商品マスタ＋状態マスタの結合。
        $orders = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('products_prices_master','orders_details_table.price_id','=','products_prices_master.id')->join('products_master','products_master.price_id','=','products_prices_master.id')->join('states_master','states_master.id','=','orders_master.state_id')->get();

        return $orders;
    }

    // 累計購入金額を取得
    public function getOrderTotal($id){

        $orders = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('products_prices_master','orders_details_table.price_id','=','products_prices_master.id')->get();

        $total = 0;

        foreach($orders as $order){
            $total += $order->product_price * $order->number;
        }

        return $total;
    }

    // クーポン使用金額
    public function getOrderCouponTotal($id){

        $orders = DB::table('orders_master')->where('orders_master.user_id', '=', $id)->join('orders_details_table','orders_details_table.id','=','orders_master.id')->join('coupons_master','coupons_master.id','=','orders_master.coupon_id')->get();

        $total = 0;

        if(count($orders) > 0) {

            foreach ($orders as $order) {
                $total += $order->coupon_discount;
            }

            return $total;

        }else{
            return $total;
        }
    }


    /**
     * 会員情報 更新・登録処理
     */
    // WEB会員情報更新
    public function updateWebCustomer($id,$user_update){

        // POSTデータの受取
        $name = $user_update['name'];
        $name_katakana = $user_update['name_katakana'];
        $postal = $user_update['postal'];
        $address1 = $user_update['address1'];
        $address2 = $user_update['address2'];
        $address3 = $user_update['address3'];
        $phone = $user_update['phone'];


        // 追加POSTデータの受取
        $birthday = $user_update['birthday'];
        $email = $user_update['email'];
        $gender_id = $user_update['gender'];


        // 更新
        $success = DB::table('users')->where('users.id', '=', $id)->update(['name' => $name, 'kana' => $name_katakana, 'email' => $email, 'gender_id' => $gender_id, 'birthday' => $birthday, 'postal' => $postal, 'address1' => $address1, 'address2' => $address2, 'address3' => $address3, 'phone' => $phone]);

        return $success;
    }

    // PHONE会員情報更新
    public function updatePhoneCustomer($id,$user_update){

        // POSTデータの受取
        $name = $user_update['name'];
        $name_katakana = $user_update['name_katakana'];
        $postal = $user_update['postal'];
        $address1 = $user_update['address1'];
        $address2 = $user_update['address2'];
        $address3 = $user_update['address3'];
        $phone = $user_update['phone'];

        // 更新
        $success = DB::table('users')->where('users.id', '=', $id)->update(['name' => $name, 'kana' => $name_katakana, 'postal' => $postal, 'address1' => $address1, 'address2' => $address2, 'address3' => $address3, 'phone' => $phone]);

        return $success;
    }

    // 新規会員登録
    public function newCustomerInsert($request){


        // POSTデータの受取
        $name = $request["name"];
        $name_katakana = $request["kana"];
        $postal = $request["postal"];
        $address1 = $request["address1"];
        $address2 = $request["address2"];
        $address3 = $request["address3"];
        $phone = $request["phone"];


        // 登録
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

        return $id;
    }


    /**
     * 商品選択
     */
    // 販売中の商品一覧
    public function getNowProducts(){

        $today = Carbon::today();
        $products = DB::table('genres_master')->join('products_master','genres_master.id','=','products_master.genre_id')->join('products_prices_master','products_master.price_id', '=', 'products_prices_master.id')->where('sales_start_date','<=',$today)->where('sales_end_date','>=',$today)->orWhere('sales_end_date','=',null)->orderBy('genre_id','asc')->get();
        return $products;
    }

    // 販売中ピザの件数
    public function getPizzaCnt(){

        $genre_id = 1;
        $today = Carbon::today();
        $cnt = DB::table('genres_master')->join('products_master','genres_master.id','=','products_master.genre_id')->join('products_prices_master','products_master.price_id', '=', 'products_prices_master.id')->where('sales_start_date','<=',$today)->where(function($query) use ($today){$query->orWhere('sales_end_date','>=',$today)->orWhere('sales_end_date','=',null);})->where('genre_id','=',$genre_id)->count();
        return $cnt;

    }

    // 販売中サイドの件数
    public function getSideCnt(){

        $genre_id = 2;
        $today = Carbon::today();
        $cnt = DB::table('genres_master')->join('products_master','genres_master.id','=','products_master.genre_id')->join('products_prices_master','products_master.price_id', '=', 'products_prices_master.id')->where('sales_start_date','<=',$today)->where(function($query) use ($today){$query->orWhere('sales_end_date','>=',$today)->orWhere('sales_end_date','=',null);})->where('genre_id','=',$genre_id)->count();
        return $cnt;

    }

    // 販売中ドリンクの件数
    public function getDrinkCnt(){

        $genre_id = 3;
        $today = Carbon::today();
        $cnt = DB::table('genres_master')->join('products_master','genres_master.id','=','products_master.genre_id')->join('products_prices_master','products_master.price_id', '=', 'products_prices_master.id')->where('sales_start_date','<=',$today)->where(function($query) use ($today){$query->orWhere('sales_end_date','>=',$today)->orWhere('sales_end_date','=',null);})->where('genre_id','=',$genre_id)->count();
        return $cnt;

    }

}