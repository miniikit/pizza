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

    $pizza = DB::table('users')->where('users.email',$email)->get();
    
    if(!isset($pizza)){
        // からの時
        dd("だめだよ");
    }


 if (isset($pizza)){
    //登録されていないメールアドレスを入力したときにエラー。
    $tmp = $pizza[0];
 
    $authId = $tmp->authority_id;

if($authId === 1 || $authId === 2 || $authId === 3){
    if(Auth::attempt(['email' => $email, 'password' => $password ])) {

        //return redirect('/pizzzzza/order/top');

        return "ログイン成功";

    }else{
        return "ログイン失敗";
    }
   }else{
       return "権限がありません";
   }
  }else{
      return "登録されていないメールアドレスです（ DEV";
  
 }
}