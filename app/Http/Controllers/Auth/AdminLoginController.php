<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller{

public function form(){
    return view('/pizzzzza/login');
}

public function login(Request $request) {

    $email = $request->get('email');
    $password = $request->get('password');

    $pizza = DB::table('users')->where('users.email',$email)->whereIn('users.authority_id',[1,2,3])->get();

    if (empty($pizza)){
 
    list($tmp) = $pizza;
    $authId = $tmp->authority_id;

if($authId === 1 || $authId === 2 || $authId === 3){
    if(Auth::attempt(['email' => $email, 'password' => $password ])) {

        //return redirect('/pizzzzza/order/top');

        return "ログイン成功";

    }else{
        return "ログイン失敗";
    }
   }  
  }else{
      return "ログインエラー";
  }
 }
}