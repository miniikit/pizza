<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class MenusController extends Controller
{
    public function index() {

        $products = Product::with('productPrice')->get()->toArray();

        return view('menu.index',compact('products'));
    }
}
