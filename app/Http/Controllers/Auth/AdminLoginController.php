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
   // $remember = $request->get('remember');

    $pizza = DB::table('users')->where('users.email',$email)->get();

    $userinfo = $pizza[0];

    $authId = $userinfo->authority_id;

if($authId === 1 || $authId === 2 || $authId === 3){
 if(Auth::attempt(['email' => $email, 'password' => $password ])){

        return redirect('/pizzzzza/order/top'); //メール、パスワード、権限がすべて一致した場合

}

else{
        return "メールアドレスまたはパスワードが間違っています"; //メール、パスワードが一致していない場合
 }
}

else{
        return "権限がありません"; //権限が４の場合
}
}

    public function logout(Request $request){ //ログアウト処理
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

}