<?php

    namespace App\Service;
    use Illuminate\Support\Facades\DB;

    /**
     *  カートの処理
     */

     class CartService {

         public function addProduct($id,$sum) {

             $products = session()->get("products",[]);

             for ($i=0; $i < $sum ; $i++) {
                //  $products[] = $product;
             }

             session()->put("products", $products);
         }

         public function clear() {
             session()->flush();
         }

     }
