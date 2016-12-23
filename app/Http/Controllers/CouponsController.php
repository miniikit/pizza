<?php
/**
 *
 *  従業員用ページ
 *      ・クーポンメニューページ
 *      【クーポン発券】
 *      ・クーポン種別選択ページ
 *      ・クーポン種別選択ページ＞値引きクーポン新規発行ページ
 *      ・クーポン種別選択ページ＞（１）プレゼントクーポン新規発行ページ
 *      ・クーポン種別選択ページ＞（２）プレゼントクーポン商品選択ページ
 *      【クーポン開催中】
 *      ・クーポン一覧ページ
 *      ・クーポン一覧ページ＞値引きクーポン編集ページ
 *      ・クーポン一覧ページ＞プレゼントクーポン編集ページ
 *      【クーポン過去一覧】
 *      ・過去クーポン一覧ページ
 *
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Coupon;
use Carbon\Carbon;

use App\Http\Requests\AdminCouponNewDiscountRequest;
use App\Http\Requests\AdminCouponNewGiftRequest;
use App\Http\Requests\AdminCouponEditDiscountRequest;
use App\Http\Requests\AdminCouponEditGiftRequest;

use phpDocumentor\Reflection\Types\Integer;

class CouponsController extends Controller
{
    //  クーポンメニューページ
    public function couponMenu()  {
        return view('pizzzzza.coupon.menu');
    }

    //  クーポン種別選択ページ＞値引きクーポン新規発行ページ
    public function couponNewDiscount()  {

        $today = Carbon::today();

        //販売期間中かつ、削除されていない商品を取得する
        $products = DB::table('products_master')->where('deleted_at','=',NULL)->where('sales_start_date','<=',$today)->where('sales_end_date','>=',$today)->orWhere('sales_end_date','=',NULL)->orderBy('genre_id','asc')->get();


        return view('pizzzzza.coupon.add.discount.input',compact('products'));

    }

    //  値引きクーポン　登録処理
    public function couponNewDiscountDo(AdminCouponNewDiscountRequest $request) {


        //
        //  エラーチェック
        //

            $today = Carbon::today();

            //開始日より終了日のほうが早ければエラー
            if($request->coupon_start_date > $request->coupon_end_date){
                flash('開始日と終了日が不正です。', 'danger');
                //※routeでなぜか参照ができないのでURLフル指定の必要あり
                return redirect('/pizzzzza/coupon/add/discount/input');
                // return redirect()->route('newCouponDiscount'); //←のこれだとできない
            }

            //終了日が過去であればエラー
            if($request->coupon_end_date < $today){
                flash('終了日は本日以降を指定してください。', 'danger');
                //※routeでなぜか参照ができないのでURLフル指定の必要あり
                return redirect('/pizzzzza/coupon/add/discount/input');
                // return redirect()->route('newCouponDiscount'); //←のこれだとできない
            }


        //
        //  「クーポン使用条件の商品」が「なし」であれば、product_idにはNULLを設定する。
        //
            if($request->coupon_product_id == 0){
                $product_id = NULL;
            }else{
                $product_id = $request->coupon_product_id;
            }

        //
        //　「クーポン利用上限回数」が「なし」であれば、nullを設定する。
        //
            if(isset($request->coupon_max)){
                $coupon_max = $request->coupon_max;
            }else{
                $coupon_max = 0;
            }


        //
        //  INSERT  SQL実行
        //

            $id = DB::table('coupons_master')->insertGetId([
                'coupons_types_id' => 1,
                'coupon_name' => $request->coupon_name,
                'coupon_discount' => $request->coupon_discount_price,
                'coupon_conditions_money' => $request->coupon_conditions_price,
                'product_id' => $product_id,
                'coupon_start_date' => $request->coupon_start_date,
                'coupon_end_date' => $request->coupon_end_date,
                'coupon_number' => $request->coupon_num,
                'coupon_conditions_count' => null,  //ひとまずnullを設定し、このSQLの次にupdate文を走らせる。
                'coupon_conditions_first' => $request->coupon_target,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        if($coupon_max >= 1){
            DB::table('coupons_master')->where('id','=',$id)->update(['coupon_conditions_count'=> $coupon_max]);
        }

            flash('クーポンの発行が完了しました。', 'success');

            return redirect()->route('showCoupon', $id);

    }

    //  プレゼントクーポン新規発行ページ
    public function couponNewGift()  {

        $today = Carbon::today();

        //販売期間中かつ、削除されていない商品を取得する
        $products = DB::table('products_master')->where('deleted_at','=',NULL)->where('sales_start_date','<=',$today)->where('sales_end_date','>=',$today)->orWhere('sales_end_date','=',NULL)->orderBy('genre_id','asc')->get();


        return view('pizzzzza.coupon.add.gift.input',compact('products'));
    }



    //  プレゼントクーポン
    public function couponNewGiftDo(AdminCouponNewGiftRequest $request) {

        //
        //  エラーチェック
        //

        $today = Carbon::today();

        //開始日より終了日のほうが早ければエラー
        if($request->coupon_start_date > $request->coupon_end_date){
            flash('開始日と終了日が不正です。', 'danger');
            //※routeでなぜか参照ができないのでURLフル指定の必要あり
            return redirect('/pizzzzza/coupon/add/discount/input');
            // return redirect()->route('newCouponDiscount'); //←のこれだとできない
        }

        //終了日が過去であればエラー
        if($request->coupon_end_date < $today){
            flash('終了日は本日以降を指定してください。', 'danger');
            //※routeでなぜか参照ができないのでURLフル指定の必要あり
            return redirect('/pizzzzza/coupon/add/discount/input');
            // return redirect()->route('newCouponDiscount'); //←のこれだとできない
        }


        //
        //  「クーポン使用条件の商品」が「なし」であれば、product_idにはNULLを設定する。
        //
        if($request->coupon_product_id == 0){
            $product_id = NULL;
        }else{
            $product_id = $request->coupon_product_id;
        }


        //
        //  coupon_present_product_idに入っている値と同額を、値引きするように。
        //

        $product_id = $request->coupon_present_product_id;
        $TmpDiscount_price = DB::table('products_master')->join('products_prices_master','products_prices_master.id','=','products_master.price_id')->where('products_master.id','=',$product_id)->select('product_price')->first();
        $discount_price = $TmpDiscount_price->product_price;
        $conditions_price = (int) $request->coupon_conditions_price;

        //
        //　「クーポン利用上限回数」が「なし」であれば、nullを設定する。
        //
        if(isset($request->coupon_max)){
            $coupon_max = $request->coupon_max;
        }else{
            $coupon_max = 0;
        }

        //
        //  INSERT  SQL実行
        //

        $id = DB::table('coupons_master')->insertGetId([
            'coupons_types_id' => 2,    //プレゼントクーポン
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $discount_price,   //値引き額を、商品から自動的に設定
            'coupon_conditions_money' => $conditions_price,   //使用条件金額
            'product_id' => $product_id,
            'coupon_start_date' => $request->coupon_start_date,
            'coupon_end_date' => $request->coupon_end_date,
            'coupon_number' => $request->coupon_num,
            'coupon_conditions_count' => null, //nullを代入し、もし値があれば次にupdate文を実行する。
            'coupon_conditions_first' => $request->coupon_target,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        if($coupon_max >= 1){
            DB::table('coupons_master')->where('id','=',$id)->update(['coupon_conditions_count'=> $coupon_max]);
        }

        flash('クーポンの発行が完了しました。', 'success');

        return redirect()->route('showCoupon', $id);
    }


    // クーポン一覧ページ
    public function couponNowList()  {

        $today = Carbon::today();

        //開始日・終了日・削除済み　の３項目を確認してクリアした一覧を取得
        $coupons = DB::table('coupons_master')->where('deleted_at','=',NULL)->where('coupon_end_date','>=',$today)->orWhere('coupon_end_date','=',null)->where('coupon_start_date','<=',$today)->get();

        return view('pizzzzza.coupon.coupon',compact('coupons'));

    }


    //  過去クーポン一覧ページ
    public function couponHistory()  {
        $coupons = DB::table('coupons_master')->get();
        return view('pizzzzza.coupon.history',compact('coupons'));
    }



    //  クーポン詳細ページ
    public function show($id)  {

        // $idのクーポン詳細情報を、クーポン種別と共に取得
        //　※ID、クーポンマスタの値を返したいのに、クーポン種別マスタのIDで上書きされる。だからIDも一緒に返却する。
        $coupon = DB::table('coupons_master')->join('coupons_types_master','coupons_types_master.id','=','coupons_master.coupons_types_id')->where('coupons_master.id','=',$id)->first();


        // 条件商品を取得
        if($coupon->product_id != 0) {

            $product_id = $coupon->product_id;
            $product = DB::table('products_master')->where('products_master.id', '=', $product_id)->first();

            //　※ID、クーポンマスタの値を返したいのに、クーポン種別マスタのIDで上書きされる。だからIDも一緒に返却する。
            return view('pizzzzza.coupon.show', compact('coupon', 'id', 'product'));

        }else{

            return view('pizzzzza.coupon.show', compact('coupon', 'id'));

        }

    }



    //  クーポン編集ページ
    public function edit($id) {
        // 処理内容：クーポンの編集画面を表示。（値引き・プレゼント両対応）
        //  １．クーポンIDを取得し、DBから値を取得
        //  ２．viewで表示する内容が若干異なるので、クーポン種別が何か判別
        //  ３．渡されたIDを基にviewのform>input>valueに初期値を設定


        //DBから取得（クーポン＋クーポン種別を、$idと一致する１つだけ取得）
            $coupon = DB::table('coupons_master')->join('coupons_types_master','coupons_master.coupons_types_id','=','coupons_types_master.id')->where('coupons_master.id','=',$id)->first();

        //もし、クーポン種別が「プレゼント」であれば、どの商品が無料になるのかを表示するために商品表と種別表と結合し、上書きする
            $couponTypeId = $coupon->coupons_types_id;
            if($couponTypeId == 2){
                $coupon = DB::table('coupons_master')->join('coupons_types_master','coupons_master.coupons_types_id','=','coupons_types_master.id')->join('products_master','coupons_master.product_id','=','products_master.id')->where('coupons_master.id','=',$id)->first();
            }


        //クーポン種別を取得する(Viewで使用）
            $couponTypes = DB::table('coupons_types_master')->get();    //12.6の変更で不要に

        //現在の商品IDを返却（checked属性を追加するために使用）
            if(isset($coupon->product_id) && $coupon->product_id != 0){
                $product_id = $coupon->product_id;
            }else{
                $product_id = null;
            }
            $today = Carbon::today();
        //商品表から、「販売中」である商品一覧を抽出
            $products = DB::table('products_master')->where('sales_start_date','<=',$today)->Where('sales_end_date','=',null)->orWhere('sales_end_date','>=',$today)->get();

        return view('pizzzzza.coupon.edit',compact('coupon','couponTypes','couponTarget','id','products','product_id'));

    }



    // クーポン更新処理：edit(編集)ページからの遷移
    public function DiscountUpdateDo(AdminCouponEditDiscountRequest $request,$id){

        if($request->status = "更新"){
            //
            //  POSTデータの受け取り
            //
                $update = array();

                //クーポン名
                $update['coupon_name'] = $request->coupon_name;
                //クーポン番号
                $update['coupon_number'] = $request->coupon_num;
                //値引き金額
                $update['coupon_discount'] = $request->coupon_discount_price;
                //利用上限回数
                if($request->coupon_max >= 1) {
                    $update['coupon_conditions_count'] = $request->coupon_max;
                }else{
                    $update['coupon_conditions_count'] = null;
                }
                //使用条件金額
                $update['coupon_conditions_money'] = $request->coupon_conditions_price;
                //使用条件商品
                $update['product_id'] = $request->coupon_product_id;
                //クーポン種別
                $update['coupons_types_id'] = $request->coupons_types_id;

                //対象者は全員か、初回利用者限定か ※POSTデータは、0(全員)、1(初回利用者限定)にしていてDBと若干異なるので、DB格納用に変換
                if($request->coupon_conditions_first == 1){
                    $update['coupon_conditions_first'] = 1;    //初回利用者のみ
                }

                //終了日
                if(isset($request->coupon_end_date) && $request->coupon_end_date != "") {
                    $update['coupon_end_date'] = $request->coupon_end_date;
                }


            //
            //  更新
            //

                DB::table('coupons_master')->where('coupons_master.id','=',$id)->update($update);
                flash('クーポンの更新が完了しました。', 'success');
                return redirect()->route('showCoupon', $id);

        }


        //
        //  エラー処理
        //

            flash('Message', 'warning');
            if(isset($id)) {
                return redirect()->route('showCoupon', $id);
            }else{
                return redirect()->route('menuCoupon');
            }

    }


    // クーポン更新処理：edit(編集)ページからの遷移
    public function GiftUpdateDo(AdminCouponEditGiftRequest $request,$id){

        if($request->status = "更新"){
            //
            //  POSTデータの受け取り
            //
            $update = array();

            //クーポン名
            $update['coupon_name'] = $request->coupon_name;
            //クーポン番号
            $update['coupon_number'] = $request->coupon_num;
            //値引き金額
            $update['coupon_discount'] = $request->coupon_discount_price;
            //利用上限回数
            if($request->coupon_max >= 1) {
                $update['coupon_conditions_count'] = $request->coupon_max;
            }else{
                $update['coupon_conditions_count'] = null;
            }
            //使用条件金額
            $update['coupon_conditions_money'] = $request->coupon_conditions_price;
            //使用条件商品
            $update['product_id'] = $request->coupon_product_id;
            //クーポン種別
            $update['coupons_types_id'] = $request->coupons_types_id;

            //対象者は全員か、初回利用者限定か ※POSTデータは、0(全員)、1(初回利用者限定)にしていてDBと若干異なるので、DB格納用に変換
            if($request->coupon_conditions_first == 1){
                $update['coupon_conditions_first'] = 1;    //初回利用者のみ
            }

            //終了日
            if(isset($request->coupon_end_date) && $request->coupon_end_date != "") {
                $update['coupon_end_date'] = $request->coupon_end_date;
            }


            //
            //  更新
            //

            DB::table('coupons_master')->where('coupons_master.id','=',$id)->update($update);
            flash('クーポンの更新が完了しました。', 'success');
            return redirect()->route('showCoupon', $id);

        }


        //
        //  エラー処理
        //

        flash('Message', 'warning');
        if(isset($id)) {
            return redirect()->route('showCoupon', $id);
        }else{
            return redirect()->route('menuCoupon');
        }

    }



    // クーポン削除処理：show(詳細)ページからの遷移
    public function delete($id){

        $now = Carbon::now();
        $today = Carbon::today();

        //未だクーポンが削除されていないことを確認
        $activeStatus = DB::table('coupons_master')->where('id','=',$id)->where('deleted_at','=',NULL)->first();

        if(count($activeStatus) > 0) {
            //まだ削除されていないので、実際に削除する
            DB::table('coupons_master')->where('coupons_master.id','=',$id)->update(['deleted_at' => $now,'coupon_end_date' => $today]);
            flash('選択されたクーポンを無効化しました。', 'success');
            return redirect()->route('showCoupon', $id);
        }else{
            //既に削除されている
            flash('既に無効化されているクーポンです。', 'warning');
            return redirect()->route('showCoupon', $id);
        }

    }


}