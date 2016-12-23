<?php


namespace App\Service;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

        // 注文マスタ＋状態マスタの結合（会員IDが一致する人の注文情報）
        $orders = DB::table('states_master')->join('orders_master','states_master.id','=','orders_master.state_id')->where('orders_master.user_id', '=', $id)->get();

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

    /**
     * 注文確認
     */
    //
    public function getPrice($request){

        $today = Carbon::today();

        $items = $request->all();

        // 商品名を取得 [0]=> "商品名"、[1]=>"商品名"...
        $keys = array_keys($items);

        // 結果を返却する配列
        $result = array();

        // 合計金額を格納する配列
        $total = 0;

        // 商品表、商品価格表から取得
        for($i = 0; $i<count($keys); $i++){

            // 商品名
            $product_name = $keys[$i];

            if($product_name == "_token" || $product_name == "date" || $product_name == "time"){
                continue;
            }
            // 商品個数
            $num = $items[$product_name];

            // DBから見つかった情報を格納
            $result[$i] = DB::table('products_master')->where('product_name','=',$product_name)->where(function($query) use ($today){$query->orWhere('sales_end_date','>=',$today)->orWhere('sales_end_date','=',null);})->join('products_prices_master','products_master.price_id','=','products_prices_master.id')->first();

            // 個数を共に格納
            $result[$i]->num = $num;

            //合計金額を算出
            $total += $result[$i]->product_price * $num;
        }

        return compact('result','total');
    }


    /**
     * 注文確定
     */
    public function insertOrder($items,$id,$appointment_date){

        $now = Carbon::now();

        // 注文マスタに登録
        $insert = array();

        $insert["order_date"] = $now;
        $insert["order_appointment_date"] = $appointment_date;
        $insert["coupon_id"] = NULL;
        $insert["state_id"] = 1;
        $insert["user_id"] = $id;
        $insert["employee_id"] = Auth::user()->id;
        $insert["created_at"] = $now;
        $insert["updated_at"] = $now;

        $orderId = DB::table('orders_master')->insertGetId($insert);

        // 注文明細マスタに登録
        foreach($items as $item){
            $insertDetails = array();
            $insertDetails["id"] = $orderId;
            $insertDetails["price_id"] = $item->price_id;
            $insertDetails["number"] = $item->num;
            $insertDetails["created_at"] = $now;
            $insertDetails["updated_at"] = $now;
            DB::table('orders_details_table')->insert($insertDetails);
        }

        // 注文IDを返却
        return $orderId;

    }
}