<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

public function form(){
    return view('pizzzzza/login');
}

public function login(Request $request) {

    //リクエストを取得
    $email = $request->get('email');
    $password = $request->get('password');

    //DBからメアドが一致するやつを取得
    $pizza = DB::table('users')->where('users.email',$email)->get();;

    //DB結果をカウントし、件数が１件でなければ、エラー処理
    $count = count($pizza);
    if($count != 1){
     return "メール登録されていません。";
    }

    //ユーザ表の情報を取得。
    $userinfo = $pizza[0];

    //権限を取得。
    $authId = $userinfo->authority_id;

    if($authId === 1 || $authId === 2){
        if(Auth::attempt(['email' => $email, 'password' => $password ])){

            session()->put('auth_id',$authId);

           return redirect('pizzzzza/order');//メール、パスワード、権限がすべて一致した場合
            
        }else{
            flash('メールアドレスまたはパスワードが間違っています', 'danger'); //メール、パスワードが一致していない場合
            return redirect('/pizzzzza/login');
      }
    
    }else{
        flash('ログインする権限がありません', 'danger'); //権限が４の場合
        return redirect('/pizzzzza/login'); 
    }
    
}

    public function logout(Request $request){ //ログアウト処理
        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/pizzzzza/login');
    }

}