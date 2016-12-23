<?php

namespace App\Service;

use App\Product;
use App\ProductPrice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MenusService
{

    public function all(){

        $today = Carbon::today();

        $products = Product::with('productPrice', 'genre')->where('sales_end_date','>=',$today)->orWhere('sales_end_date',NULL)->get();

        return $products;
    }

    public function getProduct($id) {

        $product = Product::withTrashed()->with('productPrice', 'genre')->find($id);

        return $product;
    }

    public function history(){

        $products = Product::withTrashed()->with('productPrice', 'genre')->get();

        return $products;
    }

    public function updateProduct ($request,$id) {


        //　リクエストの取得
        $data = $request->all();


        $product = $this->getProduct($id);

        // リクエストの中の画像が存在するか

        if ($request->hasFile('product_img')) {

            // 現在の日付を取得
            $carbon = Carbon::now();

            // 入力された画像を取得
            $file = $request->file('product_img');

            // 画像名前を決めて画像を所定の場所に格納
            $filename = $carbon->format('Y-m-d-H-i-s') . '.jpg';
            $file->move(public_path('images/product/'), $filename);

            $product->product_image = '/images/product/' . $filename;

        }

        // 終了日が決まっているか判断
        if (empty($data['product_sales_end_day'])) {
            $endDate = NULL;
        } else {
            $endDate = $data['product_sales_end_day'];
        }


        // 金額が変更されている場合の処理
        if ($product->productPrice->product_price != $data['product_price']) {

            // 新規のProductPriceを発行
            $price = ProductPrice::create([
                'product_id' => $product->id,
                'product_price' => $data['product_price'],
                'price_change_startdate' => $data['product_sales_start_day'],
                'price_change_enddate' => $endDate,
                'employee_id' => Auth::user()->id,
            ]);

            // 前回のProductPriceを停止
            $lostPrice = ProductPrice::find($product->price_id);
            $lostPrice->price_change_enddate = Carbon::today();
            $lostPrice->save();

            // price_idを変更する
            $product->price_id = $price->id;

        }

        // Productの値の変更する
        $product->product_name = $data['product_name'];
        $product->product_text  = $data['product_text'];
        $product->genre_id = $data['product_genre_id'];
        $product->sales_start_date = $data['product_sales_start_day'];
        $product->sales_end_date = $endDate;

        $product->save();

    }

    public function addProduct($request){

        // リクエストの取得
        $data = $request->all();

        // 現在の日付を取得
        $carbon = Carbon::now();

        // 入力された画像を取得
        $file = $request->file('product_img');

        // 画像名前を決めて画像を所定の場所に格納
        $filename = $carbon->format('Y-m-d-H-i-s') . '.jpg';
        $file->move(public_path('images/product/'), $filename);


        // 終了日が決まっているか判断
        if (empty($data['product_sales_end_day'])) {
            $endDate = NULL;
        } else {
            $endDate = $data['product_sales_end_day'];
        }

        // 新規商品の発行
        $product = Product::create([
            'product_name' => $data['product_name'],
            'price_id' => 0,
            'product_image' => '/images/product/' . $filename,
            'product_text' => $data['product_text'],
            'genre_id' => $data['product_genre_id'],
            'sales_start_date' => $data['product_sales_start_day'],
            'sales_end_date' => $endDate,
        ]);

        // 新規価格の発行
        $price  =ProductPrice::create([
            'product_id' => $product->id,
            'product_price' => $data['product_price'],
            'price_change_startdate' => $data['product_sales_start_day'],
            'price_change_enddate' => $endDate,
            'employee_id' => Auth::user()->id,
        ]);

        // 新規価格を商品に紐づける
        $product->price_id = $price->id;
        $product->save();

    }


    public function destroy($id)
    {

        $product = $this->getProduct($id);

        $product->sales_end_date = Carbon::today();
        $product->save();

        $product->delete();


    }

}