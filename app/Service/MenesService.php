<?php

namespace App\Service;

use App\Product;
use Carbon\Carbon;

class MenusService
{

    public function destroy($id)
    {

        $product = Product::with('productPrice', 'genre')->find($id);

        $product->sales_end_date = Carbon::today();
        $product->save();

        $product->delete();


    }

}