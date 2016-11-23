<?php

    namespace App\Service;
    use App\Product;

    /**
     *  カートの処理
     */

     class CartService {


         // カートの中身を返す
         public function showCart() {

             //セッションデータを取得、nullの場合は空の配列
             $products = session()->get("products",[]);
             $productCount = session()->get("productCount",[]);
             $total = 0;

            foreach ($products as $product) {
                // 合計金額の処理
                $total += $product->productPrice->product_price * $productCount[$product->id];
            }


            return [$products,$productCount,$total];

         }


         // 商品追加処理
         public function addProduct($id,$sum) {

             // セッションデータを取得、nullの場合は空の配列
             $products = session()->get("products",[]);
             $productCount = session()->get("productCount",[]);

             // 引数idの商品を取得
             $product = Product::with('productPrice')->find($id);

             $products[$id] = $product;


             if (isset($productCount[$id])) {

                 if ($productCount[$id] + $sum > 10) {
                    $productCount[$id] = 10;
                }else {
                    $productCount[$id] += $sum;
                }

             }else {
                 $productCount[$id] = $sum;
             }

             // セッションに格納する
             session()->put("products", $products);
             session()->put("productCount", $productCount);
         }


         // カートの中身を空にする
         static public function clear() {
             session()->flush();
         }


         static public function countCartContents() {

             $productCount = session()->get("productCount",[]);
             $count = count($productCount);

            return compact('count');
         }

         //　一部商品を消す
         public function popProduct($id) {

             $products = session()->get("products",[]);
             $productCount = session()->get("productCount",[]);


             unset($products[$id]);
             unset($productCount[$id]);

             session()->put("products", $products);
             session()->put("productCount", $productCount);

         }

         public function editCartSum($id,$sum) {

             $productCount = session()->get("productCount",[]);

             $productCount[$id] = $sum;

             session()->put("productCount", $productCount);
         }

     }
